<?php

namespace App\Http\Resources\Address\Components;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Houses extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\Address\Components\House';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'houses' => $this->collection,
        ];
    }
}
