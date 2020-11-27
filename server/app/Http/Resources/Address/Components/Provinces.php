<?php

namespace App\Http\Resources\Address\Components;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Provinces extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\Address\Components\Province';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'provinces' => $this->collection,
        ];
    }
}
