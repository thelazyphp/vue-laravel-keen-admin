<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;

class CadastralRecordsFilter extends QueryFilter
{
    /**
     * {@inheritDoc}
     */
    protected function casts(Request $request)
    {
        return [
            'typeId' => 'type_id',
            'countryId' => 'country_id',
            'provinceId' => 'province_id',
            'areaId' => 'area_id',
            'localityId' => 'locality_id',
            'districtId' => 'district_id',
            'metroId' => 'metro_id',
            'streetId' => 'street_id',
            'houseId' => 'house_id',
            'entranceId' => 'entrance_id',
            'functionId' => 'function_id',
            'entryDate' => 'entry_date',
            'transactionDate' => 'transaction_date',
            'priceUsd' => 'price_usd',
            'priceSqmUsd' => 'price_sqm_usd',
            'piecesAfterTransaction' => 'pieces_after_transaction',
            'capitalFloors' => 'capital_floors',
            'capitalUndergroundFloors' => 'capital_underground_floors',
            'landSize' => 'land_size',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function filterable(Request $request)
    {
        return [
            'id',
            'type_id',
            'country_id',
            'province_id',
            'area_id',
            'locality_id',
            'district_id',
            'metro_id',
            'street_id',
            'house_id',
            'entrance_id',
            'function_id',
            'size',
            'entry_date',
            'transaction_date',
            'price_usd',
            'price_sqm_usd',
            'pieces_after_transaction',
            'rooms',
            'floor',
            'capital_floors',
            'capital_underground_floors',
            'land_size',
        ];
    }
}
