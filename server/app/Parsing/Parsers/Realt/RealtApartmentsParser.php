<?php

namespace App\Parsing\Parsers\Realt;

use App\Parsing\Parsers\ApartmentsParser;
use App\Parsing\Facades\Rule;
use App\Parsing\DOM\Document;
use Throwable;
use App\Models\Ad;
use App\Models\Seller;

class RealtApartmentsParser extends ApartmentsParser
{
    /**
     * {@inheritDoc}
     */
    protected $source = 'realt.by';

    /**
     * {@inheritDoc}
     */
    protected function registerRules()
    {
        $this->rules['images'] = Rule::findAll('.lightgallery')->map(function ($element) {
            return [
                'src' => Rule::attr('href')->evaluate($element),
                'thumb' => Rule::find('img')->attr('src')->evaluate($element),
            ];
        });

        $this->rules['title'] = Rule::find('.f24')->text();

        $this->rules['address_province'] = Rule::findWhereText('.table-row-left', 'Область')->nextSibling()->text();

        $this->rules['address_area'] = Rule::findWhereText('.table-row-left', 'Район (области)')->nextSibling()->replace(' район', '')->append(' район');

        $this->rules['address_locality'] = Rule::findWhereText('.table-row-left', 'Населенный пункт')->nextSibling()->text();

        $this->rules['address_district'] = Rule::findWhereText('.table-row-left', 'Район города')->nextSibling()->explode(': ')->take(0)->replace(' район', '');

        $this->rules['address_microdistrict'] = Rule::findWhereText('.table-row-left', 'Район города')->nextSibling()->explode(': ')->take(1);

        $this->rules['address_street'] = Rule::findWhereText('.table-row-left', 'Адрес')->nextSibling()->text();

        $this->rules['address_coordinates_lat'] = Rule::find('#map-center')->attr('data-center')->replace('position.', 'position')->fromJson()->take('position.y');

        $this->rules['address_coordinates_long'] = Rule::find('#map-center')->attr('data-center')->replace('position.', 'position')->fromJson()->take('position.x');

        $this->rules['rooms'] = Rule::findWhereText('.table-row-left', 'Комнат всего/разд.')->nextSibling()->takeInteger();

        $this->rules['floor'] = Rule::findWhereText('.table-row-left', 'Этаж / этажность')->nextSibling()->explode(' / ')->take(0)->takeInteger();

        $this->rules['floors'] = Rule::findWhereText('.table-row-left', 'Этаж / этажность')->nextSibling()->explode(' / ')->take(1)->takeInteger();

        $this->rules['year_built'] = Rule::findWhereText('.table-row-left', 'Год постройки')->nextSibling()->takeInteger();

        $this->rules['walls'] = Rule::findWhereText('.table-row-left', 'Тип дома')->nextSibling()->text();

        $this->rules['balcony'] = Rule::findWhereText('.table-row-left', 'Балкон')->nextSibling()->text();

        $this->rules['bathroom'] = Rule::findWhereText('.table-row-left', 'Сан/узел')->nextSibling()->text();

        $this->rules['size_total'] = Rule::findWhereText('.table-row-left', 'Площадь общая/жилая/кухня')->nextSibling()->explode(' / ')->take(0)->takeNumeric();

        $this->rules['size_living'] = Rule::findWhereText('.table-row-left', 'Площадь общая/жилая/кухня')->nextSibling()->explode(' / ')->take(1)->takeNumeric();

        $this->rules['size_kitchen'] = Rule::findWhereText('.table-row-left', 'Площадь общая/жилая/кухня')->nextSibling()->explode(' / ')->take(2)->takeNumeric();

        $this->rules['price_amount'] = Rule::find('.price-switchable')->attr('data-0')->explode(',')->take(0)->takeDigits();

        $this->rules['price_sq_m_amount'] = Rule::find('.price-switchable')->attr('data-0')->explode(',')->take(1)->takeDigits();

        $this->rules['published_at'] = Rule::findWhereText('.table-row-left', 'Дата обновления')->nextSibling()->text();
    }

    /**
     * {@inheritDoc}
     */
    protected function parse()
    {
        $endpoints = [
            // 'https://realt.by/newflats/',
            // 'https://realt.by/sale/flats/',
            // 'https://realt.by/rent/flat-for-long/',
            'https://realt.by/brest-region/newflats/',
            'https://realt.by/brest-region/sale/flats/',
            'https://realt.by/brest-region/rent/flat-for-long/',
            // 'https://realt.by/grodno-region/newflats/',
            // 'https://realt.by/grodno-region/sale/flats/',
            // 'https://realt.by/grodno-region/rent/flat-for-long/',
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

            $lastPage = Rule::findLast('.uni-paging a')->attr('href')->match('/page=(\d+)/', 1)->evaluate($document);

            for ($page = 0; $page <= $lastPage; $page++) {
                try {
                    $res = $this->client->get(
                        $page == 0 ? $endpoint : $endpoint.'?page='.$page
                    );
                } catch (Throwable $e) {
                    //

                    continue;
                }

                if (!$document->loadHTML((string) $res->getBody())) {
                    //

                    continue;
                }

                foreach ($document->querySelectorAll('.title a') as $element) {
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

        if (strpos($url, '/sale/') !== false) {
            $attributes['transaction'] = Ad::TRANSACTION_SELL;
        } else {
            $attributes['transaction'] = Ad::TRANSACTION_RENT;
        }

        $attributes['full_address'] = '';

        if (!empty($attributes['address_province'])) {
            $attributes['full_address'] .= $attributes['address_province'];
        }

        if (!empty($attributes['address_area'])) {
            $attributes['full_address'] .= ', '.$attributes['address_area'];
        }

        if (!empty($attributes['address_locality'])) {
            $attributes['full_address'] .= ', '.$attributes['address_locality'];
        }

        if (!empty($attributes['address_street'])) {
            $attributes['full_address'] .= ', '.$attributes['address_street'];
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

        if (Rule::findWhereText('.table-row-left', 'Агентство')->nextSibling()->empty($document)) {
            $seller['type'] = Seller::TYPE_OWNER;
        } else {
            $seller['type'] = Seller::TYPE_AGENT;
        }

        $seller['name'] = Rule::findWhereText('.table-row-left', 'Контактное лицо')->nextSibling()->text()->evaluate($document);

        if (empty($seller['name'])) {
            $seller['name'] = Rule::findWhereText('.table-row-left', 'Специалист')->nextSibling()->find('.name')->text()->evaluate($document);
        }

        if (empty($seller['name'])) {
            $seller['name'] = Rule::findWhereText('.table-row-left', 'Агентство')->nextSibling()->text()->evaluate($document);
        }

        $seller['email'] = Rule::findWhereText('.table-row-left', 'E-mail')->nextSibling()->replace('(собачка)', '@')->evaluate($document);

        $seller['phone'] = Rule::find('.phone-operator[data-full^="+"]')->attr('data-full')->takeDigits()->prepend('+')->evaluate($document);

        $seller = Seller::updateOrCreate(['phone' => $seller['phone']], $seller);
        $model->seller()->associate($seller);
    }
}
