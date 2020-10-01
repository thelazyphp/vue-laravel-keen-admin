<?php

namespace App\Parsing\Parsers\Onliner;

use App\Parsing\Parsers\ApartmentsParser;
use App\Parsing\Facades\Rule;
use Throwable;
use App\Parsing\DOM\Document;
use App\Models\Ad;
use App\Models\Seller;

class OnlinerApartmentsParser extends ApartmentsParser
{
    /**
     * {@inheritDoc}
     */
    protected $source = 'onliner.by';

    /**
     * {@inheritDoc}
     */
    protected function registerRules()
    {
        $this->rules['images'] = Rule::findAll('.apartment-gallery__slide')->map(function ($element) {
            return [
                'src'   => Rule::attr('style')->match('/url\([\'"]?(.+?)[\'"]?\)/i', 1)->evaluate($element),
                'thumb' => Rule::attr('data-thumb')->evaluate($element),
            ];
        });

        $this->rules['title'] = Rule::find('title')->text();

        $this->rules['full_address'] = Rule::find('.apartment-info__sub-line_large')->text();

        $this->rules['rooms'] = Rule::findWhereTextContains('.apartment-bar__value', 'комнатная квартира')->takeInteger();

        $this->rules['floor'] = Rule::findWhereText('.apartment-options-table__sub', 'Этаж')->parent(3)->lastChild()->explode('/')->take(0)->takeInteger();

        $this->rules['floor'] = Rule::findWhereText('.apartment-options-table__sub', 'Этаж')->parent(3)->lastChild()->explode('/')->take(1)->takeInteger();

        $this->rules['year_built'] = Rule::findWhereTextMatches('.apartment-options__item', '/дом\s+\d+\s+года/')->takeDigits();

        $this->rules['walls'] = Rule::findWhereTextMatches('.apartment-options__item', '/дом\s+\d+\s+года/')->match('/(.+)\s+дом\s+\d+\s+года/', 1);

        $this->rules['size_total'] = Rule::findWhereText('.apartment-options-table__sub', 'Общая')->parent(3)->lastChild()->takeNumeric();

        $this->rules['size_living'] = Rule::findWhereText('.apartment-options-table__sub', 'Жилая')->parent(3)->lastChild()->takeNumeric();

        $this->rules['size_kitchen'] = Rule::findWhereText('.apartment-options-table__sub', 'Кухня')->parent(3)->lastChild()->takeNumeric();

        $this->rules['price_amount'] = Rule::find('.apartment-bar__price-value_complementary')->takeDigits();
    }

    /**
     * {@inheritDoc}
     */
    protected function parse()
    {
        $endpoints = [
            // 'https://pk.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=53.820922446131&bounds%5Blb%5D%5Blong%5D=27.344970703125&bounds%5Brt%5D%5Blat%5D=53.97547425743&bounds%5Brt%5D%5Blong%5D=27.77961730957&v=0.5865389600556095',
            'https://pk.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=51.941725203142&bounds%5Blb%5D%5Blong%5D=23.492889404297&bounds%5Brt%5D%5Blat%5D=52.234528294214&bounds%5Brt%5D%5Blong%5D=23.927536010742&v=0.2820295688977792',
            // 'https://pk.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=55.085834940707&bounds%5Blb%5D%5Blong%5D=29.979629516602&bounds%5Brt%5D%5Blat%5D=55.357648391381&bounds%5Brt%5D%5Blong%5D=30.414276123047&v=0.5114354605477842',
            // 'https://pk.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=52.302600726968&bounds%5Blb%5D%5Blong%5D=30.732192993164&bounds%5Brt%5D%5Blat%5D=52.593037841157&bounds%5Brt%5D%5Blong%5D=31.166839599609&v=0.07077596426404642',
            // 'https://pk.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=53.538267122397&bounds%5Blb%5D%5Blong%5D=23.629531860352&bounds%5Brt%5D%5Blat%5D=53.820517109806&bounds%5Brt%5D%5Blong%5D=24.064178466797&v=0.7914331968283197',
            // 'https://pk.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=53.74261986683&bounds%5Blb%5D%5Blong%5D=30.132064819336&bounds%5Brt%5D%5Blat%5D=54.023503252809&bounds%5Brt%5D%5Blong%5D=30.566711425781&v=0.3405733290973898',
            // 'https://ak.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=53.820922446131&bounds%5Blb%5D%5Blong%5D=27.344970703125&bounds%5Brt%5D%5Blat%5D=53.97547425743&bounds%5Brt%5D%5Blong%5D=27.77961730957&v=0.9405638515027628',
            'https://ak.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=51.941725203142&bounds%5Blb%5D%5Blong%5D=23.492889404297&bounds%5Brt%5D%5Blat%5D=52.234528294214&bounds%5Brt%5D%5Blong%5D=23.927536010742&v=0.40241429960810526',
            // 'https://ak.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=55.085834940707&bounds%5Blb%5D%5Blong%5D=29.979629516602&bounds%5Brt%5D%5Blat%5D=55.357648391381&bounds%5Brt%5D%5Blong%5D=30.414276123047&v=0.24555523245536892',
            // 'https://ak.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=52.302600726968&bounds%5Blb%5D%5Blong%5D=30.732192993164&bounds%5Brt%5D%5Blat%5D=52.593037841157&bounds%5Brt%5D%5Blong%5D=31.166839599609&v=0.6062356227616696',
            // 'https://ak.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=53.538267122397&bounds%5Blb%5D%5Blong%5D=23.629531860352&bounds%5Brt%5D%5Blat%5D=53.820517109806&bounds%5Brt%5D%5Blong%5D=24.064178466797&v=0.23028207189523897',
            // 'https://ak.api.onliner.by/search/apartments?bounds%5Blb%5D%5Blat%5D=53.74261986683&bounds%5Blb%5D%5Blong%5D=30.132064819336&bounds%5Brt%5D%5Blat%5D=54.023503252809&bounds%5Brt%5D%5Blong%5D=30.566711425781&v=0.8018297591785657',
        ];

        foreach ($endpoints as $endpoint) {
            try {
                $res = $this->client->get(
                    $endpoint, ['headers' => ['accept' => 'application/json, text/plain, */*']]
                );
            } catch (Throwable $e) {
                //

                continue;
            }

            if (($data = json_decode((string) $res->getBody())) === null) {
                //

                continue;
            }

            $lastPage = $data->page->last;

            for ($page = 1; $page <= $lastPage; $page++) {
                try {
                    $res = $this->client->get(
                        $endpoint.'&page='.$page, ['headers' => ['accept' => 'application/json, text/plain, */*']]
                    );
                } catch (Throwable $e) {
                    //

                    continue;
                }

                if (($data = json_decode((string) $res->getBody())) === null) {
                    //

                    continue;
                }

                foreach ($data->apartments as $apartment) {
                    try {
                        $this->parsePage($apartment->url);
                    } catch (Throwable $e) {
                        //

                        continue;
                    }
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function attributesParsed(
        Document $document,
        $url,
        &$attributes)
    {
        parent::attributesParsed(
            $document,
            $url,
            $attributes
        );

        if (strpos($url, '/pk/') !== false) {
            $attributes['transaction'] = Ad::TRANSACTION_SELL;
        } else {
            $attributes['transaction'] = Ad::TRANSACTION_RENT;
        }

        foreach (Rule::findAll('script')->evaluate($document) as $script) {
            $text = $script->textContent;

            if (strpos($text, '"started_at"') !== false) {
                if (preg_match('/"started_at":"(.+?)"/', $text, $matches)) {
                    if (isset($matches[1])) {
                        $attributes['published_at'] = $matches[1];
                    }
                }
            } elseif (strpos($text, 'latitude') !== false) {
                if (preg_match('/latitude\s=\s([\d.]+),/', $text, $matches)) {
                    if (isset($matches[1])) {
                        $attributes['address_coordinates_lat'] = $matches[1];
                    }
                }

                if (preg_match('/longitude\s=\s([\d.]+),/', $text, $matches)) {
                    if (isset($matches[1])) {
                        $attributes['address_coordinates_long'] = $matches[1];
                    }
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function modelCreated(
        Document $document,
        $url,
        Ad $model,
        &$attributes)
    {
        $seller = [];

        if (Rule::findWhereText('.apartment-bar__value', 'Собственник')->empty($document)) {
            $seller['type'] = Seller::TYPE_AGENT;
        } else {
            $seller['type'] = Seller::TYPE_OWNER;
        }

        $seller['name'] = Rule::find('[href^="https://profile.onliner.by/user/"]')->text()->evaluate($document);

        $seller['phone'] = Rule::find('[href^="tel:+"]')->attr('href')->takeDigits()->prepend('+')->evaluate($document);

        $seller = Seller::updateOrCreate(['phone' => $seller['phone']], $seller);
        $model->seller()->associate($seller);
    }
}
