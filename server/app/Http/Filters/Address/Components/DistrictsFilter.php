<?php

namespace App\Http\Filters\Address\Components;

use App\Http\Filters\QueryFilter;
use Illuminate\Http\Request;

class DistrictsFilter extends QueryFilter
{
    /**
     * {@inheritDoc}
     */
    protected function casts(Request $request)
    {
        return [
            'countryId' => 'country_id',
            'provinceId' => 'province_id',
            'areaId' => 'area_id',
            'localityId' => 'locality_id',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function filterable(Request $request)
    {
        return [
            'id',
            'country_id',
            'province_id',
            'area_id',
            'locality_id',
        ];
    }
}
