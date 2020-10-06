<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \App\Filters\Filter  $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $builder, Filter $filter)
    {
        return $filter->filter($builder);
    }
}
