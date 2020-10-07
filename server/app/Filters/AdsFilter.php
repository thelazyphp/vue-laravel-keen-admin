<?php

namespace App\Filters;

use App\Models\Seller;

class AdsFilter extends Filter
{
    /**
     * {@inheritDoc}
     */
    protected $defaults = [
        'sort' => '-published_at',
    ];

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function q($value)
    {
        return $this->builder->where(function ($builder) use ($value) {
            $builder = $builder->where(
                'full_address', 'like', '%'.$value.'%'
            );

            $builder = $builder->where(
                'address_district', 'like', '%'.$value.'%'
            );

            return $builder->orWhere(
                'address_microdistrict', 'like', '%'.$value.'%'
            );
        });
    }

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sellerType ($value) {
        return $this->builder->whereIn(
            'seller_id', Seller::select('id')->where('type', $value)->get()->pluck('id')->toArray()
        );
    }
}
