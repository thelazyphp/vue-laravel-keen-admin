<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;

trait Filterable
{
    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \App\Filters\QueryFilter  $queryFilter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $queryFilter)
    {
        return $queryFilter->apply($builder);
    }
}
