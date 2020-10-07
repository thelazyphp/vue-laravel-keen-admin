<?php

namespace App\Parsing\Parsers\Irr;

use App\Parsing\Parsers\ApartmentsParser;
use App\Parsing\Facades\Rule;
use App\Parsing\DOM\Document;
use Throwable;
use App\Models\Ad;
use App\Models\Seller;

class IrrApartmentsParser extends ApartmentsParser
{
    /**
     * {@inheritDoc}
     */
    protected $source = 'irr.by';

    /**
     * {@inheritDoc}
     */
    protected $options = [
        'client' => [
            'verify' => false,

            'headers' => [
                'accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'accept-language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            ],
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function registerRules()
    {
        $this->rules['images'] = Rule::findAll('.nyroModal')->map(function ($element) {
            return [
                'src'   => Rule::attr('href')->evaluate($element),
                'thumb' => Rule::find('img')->attr('src')->evaluate($element),
            ];
        });

        $this->rules['title'] = Rule::find('.title3')->replace('  ', ' ');

        $this->rules['full_address'] = Rule::find('.address_link')->text();

        $this->rules['address_district'] = Rule::find('.cf_block_address_district')->lastChild()->text();

        $this->rules['address_microdistrict'] = Rule::find('.cf_block_address_microdistrict')->lastChild()->text();

        $this->rules['address_street'] = Rule::find('.cf_block_mapStreet')->lastChild()->text();

        $this->rules['address_coordinates_lat'] = Rule::find('#map_container script')->match('/i_geoLat\s+=\s+([\d.]+);/', 1);

        $this->rules['address_coordinates_long'] = Rule::find('#map_container script')->match('/i_geoLng\s+=\s+([\d.]+);/', 1);

        $this->rules['rooms'] = Rule::find('.cf_block_rooms')->lastChild()->takeInteger();

        $this->rules['floor'] = Rule::find('.cf_block_etage')->lastChild()->takeInteger();

        $this->rules['floors'] = Rule::find('.cf_block_etage_all')->lastChild()->takeInteger();

        $this->rules['year_built'] = Rule::find('.cf_block_house_year')->lastChild()->takeInteger();

        $this->rules['walls'] = Rule::find('.cf_block_walltype')->lastChild()->text();

        $this->rules['balcony'] = Rule::find('.cf_block_balcony')->lastChild()->text();

        $this->rules['bathroom'] = Rule::find('.cf_block_toilet')->lastChild()->text();

        $this->rules['size_total'] = Rule::find('.cf_block_meters_total')->lastChild()->takeNumeric();

        $this->rules['size_living'] = Rule::find('.cf_block_meters_living')->lastChild()->takeNumeric();

        $this->rules['size_kitchen'] = Rule::find('.cf_block_kitchen')->lastChild()->takeNumeric();

        $this->rules['price_amount'] = Rule::findWhereTextContains('.credit_cost li', '$')->takeDigits();

        $arr = [
            'января'   => 'jan',
            'февраля'  => 'feb',
            'марта'    => 'mar',
            'апреля'   => 'apr',
            'мая'      => 'may',
            'июня'     => 'jun',
            'июля'     => 'jul',
            'августа'  => 'aug',
            'сентября' => 'sep',
            'октября'  => 'oct',
            'ноября'   => 'nov',
            'декабря'  => 'dec',
        ];

        $this->rules['published_at'] = Rule::find('.data')->replace(array_keys($arr), array_values($arr))->toDateTime();
    }

    /**
     * {@inheritDoc}
     */
    protected function parse()
    {
        $endpoints = [
            'http://brest.irr.by/realestate/sale-flats/',
            'http://brest.irr.by/realestate/new/',
            'http://brest.irr.by/realestate/longtime/',
        ];

        $document = new Document();

        foreach ($endpoints as $endpoint) {
            try {
                $res = $this->client->get($endpoint);
            } catch (Throwable $e) {
                //

                continue;
            }

            if (!$document->loadHTML((string) $res->getBody())) {
                //

                continue;
            }

            $lastPage = Rule::findLast('.js-paginatorPage')->takeInteger()->evaluate($document);

            for ($page = 0; $page <= $lastPage; $page++) {
                try {
                    $res = $this->client->get("{$endpoint}search/list=list/page{$page}/");
                } catch (Throwable $e) {
                    //

                    continue;
                }

                if (!$document->loadHTML((string) $res->getBody())) {
                    //

                    continue;
                }

                foreach ($document->querySelectorAll('.add_title') as $element) {
                    try {
                        $this->parsePage($element->href);
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

        if (
            strpos($url, '/new/') !== false
            || strpos($url, '/sale-flats/') !== false
            || strpos($url, '/rooms/') !== false
            || strpos($url, '/exchange-flats/') !== false
        ) {
            $attributes['transaction'] = Ad::TRANSACTION_SELL;
        } else {
            $attributes['transaction'] = Ad::TRANSACTION_RENT;
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
        parent::modelCreated(
            $document,
            $url,
            $model,
            $attributes
        );

        $seller = [];

        if (Rule::findWhereText('.form_info p', 'Продавец:')->nextSibling()->match('/Частное\s+объявление/')->empty($document)) {
            $seller['type'] = Seller::TYPE_AGENT;
        } else {
            $seller['type'] = Seller::TYPE_OWNER;
        }

        $seller['name'] = Rule::findWhereText('.form_info p', 'Контактное лицо:')->nextSibling()->text()->evaluate($document);

        if ($seller['type'] == Seller::TYPE_AGENT) {
            if (empty($seller['name'])) {
                $seller['name'] = Rule::findWhereText('.form_info p', 'Продавец:')->nextSibling()->match('/(.+)\s+—\s+Все\s+объявления\s+продавца/', 1)->evaluate($document);
            }

            if (empty($seller['name'])) {
                $seller['name'] = Rule::findWhereText('.form_info p', 'Продавец:')->nextSibling()->text()->evaluate($document);
            }
        }

        $seller = Seller::create($seller);
        $model->seller()->associate($seller);
    }
}
