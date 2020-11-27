<?php

namespace App\Http\Resources\Address\Components;

use Illuminate\Http\Resources\Json\JsonResource;

class Locality extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'locality';

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
            'provinceId' => $this->province_id,
            'areaId' => $this->area_id,
        ];
    }
}
