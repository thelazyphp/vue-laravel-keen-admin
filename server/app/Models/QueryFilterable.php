<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\QueryFilter;

trait QueryFilterable
{
    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \App\Http\Filters\QueryFilter  $queryFilter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeQueryFilter(Builder $builder, QueryFilter $queryFilter)
    {
        return $queryFilter->apply($builder);
    }
}
