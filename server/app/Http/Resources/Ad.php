<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ad extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'is_favorite'  => $this->isFavorite(),
            'id'           => $this->id,
            'seller'       => $this->seller,
            'transaction'  => $this->transaction,
            'category'     => $this->category,
            'type'         => $this->type,
            'source'       => $this->source,
            'url'          => $this->url,
            'images'       => $this->images,
            'title'        => $this->title,
            'full_address' => $this->full_address,

            'address' => [
                'country'       => $this->address_country,
                'province'      => $this->address_province,
                'area'          => $this->address_area,
                'locality'      => $this->address_locality,
                'district'      => $this->address_district,
                'microdistrict' => $this->address_microdistrict,
                'street'        => $this->address_street,
                'house'         => $this->address_house,

                'coordinates' => [
                    'lat'  => $this->address_coordinates_lat,
                    'long' => $this->address_coordinates_long,
                ],
            ],

            'rooms'      => $this->rooms,
            'floor'      => $this->floor,
            'floors'     => $this->floors,
            'year_built' => $this->year_built,

            'size' => [
                'land'    => $this->size_land,
                'total'   => $this->size_total,
                'living'  => $this->size_living,
                'kitchen' => $this->size_kitchen,
            ],

            'roof'     => $this->roof,
            'walls'    => $this->walls,
            'balcony'  => $this->balcony,
            'bathroom' => $this->bathroom,

            'price' => [
                'history'  => $this->price_history,
                'amount'   => $this->price_amount,
                'currency' => $this->price_currency,

                'sq_m' => [
                    'history'  => $this->price_sq_m_history,
                    'amount'   => $this->price_sq_m_amount,
                    'currency' => $this->price_sq_m_currency,
                ],
            ],

            'published_at' => $this->published_at,
        ];
    }
}
