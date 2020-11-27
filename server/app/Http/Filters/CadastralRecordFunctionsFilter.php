<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;

class CadastralRecordFunctionsFilter extends QueryFilter
{
    /**
     * {@inheritDoc}
     */
    protected function casts(Request $request)
    {
        return [
            'typeId' => 'type_id',
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
        ];
    }
}
