<?php

namespace App\Http\Resources\Address\Components;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Entrances extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\Address\Components\Entrance';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'entrances' => $this->collection,
        ];
    }
}
