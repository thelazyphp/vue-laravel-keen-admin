<?php

namespace App\Http\Resources\Address\Components;

use Illuminate\Http\Resources\Json\JsonResource;

class Province extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'province';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'countryId' => $this->country_id,
        ];
    }
}
