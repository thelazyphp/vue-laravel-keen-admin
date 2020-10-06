<?php

namespace App\Filters;

use App\Models\Seller;

class AdsFilter extends Filter
{
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
