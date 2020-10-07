<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \App\Filters\Filter  $filter
     * @param  array  $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $builder, Filter $filter, $params)
    {
        return $filter->filter($builder, $params);
    }
}
