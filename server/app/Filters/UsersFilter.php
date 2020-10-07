<?php

namespace App\Filters;

use App\Models\Role;

class UsersFilter extends Filter
{
    /**
     * {@inheritDoc}
     */
    protected $defaults = [
        'sort' => 'first_name',
    ];

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function q($value)
    {
        return $this->builder->where(function ($builder) use ($value) {
            $builder = $builder->where(
                'last_name', 'like', '%'.$value.'%'
            );

            return $builder->orWhere(
                'first_name', 'like', '%'.$value.'%'
            );
        });
    }

    /**
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function roleIn ($value) {
        return $this->builder->whereIn(
            'role_id', Role::whereIn('name', explode(',', $value))->get()->pluck('id')->toArray()
        );
    }
}
