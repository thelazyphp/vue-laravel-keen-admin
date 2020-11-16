<?php

namespace App\Filters;

use Illuminate\Http\Request;

class UsersFilter extends QueryFilter
{
    /**
     * {@inheritDoc}
     */
    protected function filterable(Request $request)
    {
        return [
            'id',
            'name',
            'email',
        ];
    }
}
