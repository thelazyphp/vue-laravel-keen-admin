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
            'is_favorite'               => $this->isFavorite(),
            'id'                        => $this->id,
            'seller'                    => $this->seller,
            'transaction'               => $this->transaction,
            'category'                  => $this->category,
            'type'                      => $this->type,
            'source'                    => $this->source,
            'url'                       => $this->url,
            'images'                    => $this->images,
            'title'                     => $this->title,
            'full_address'              => $this->full_address,
            'address_country'           => $this->address_country,
            'address_province'          => $this->address_province,
            'address_area'              => $this->address_area,
            'address_locality'          => $this->address_locality,
            'address_district'          => $this->address_district,
            'address_microdistrict'     => $this->address_microdistrict,
            'address_street'            => $this->address_street,
            'address_house'             => $this->address_house,
            'address_coordinates_lat'   => $this->address_coordinates_lat,
            'address_coordinates_long'  => $this->address_coordinates_long,
            'rooms'                     => $this->rooms,
            'floor'                     => $this->floor,
            'floors'                    => $this->floors,
            'year_built'                => $this->year_built,
            'size_land'                 => $this->size_land,
            'size_total'                => $this->size_total,
            'size_living'               => $this->size_living,
            'size_kitchen'              => $this->size_kitchen,
            'roof'                      => $this->roof,
            'walls'                     => $this->walls,
            'balcony'                   => $this->balcony,
            'bathroom'                  => $this->bathroom,
            'price_history'             => $this->price_history,
            'price_amount'              => $this->price_amount,
            'price_currency'            => $this->price_currency,
            'price_sq_m_history'        => $this->price_sq_m_history,
            'price_sq_m_amount'         => $this->price_sq_m_amount,
            'price_sq_m_currency'       => $this->price_sq_m_currency,
            'published_at'              => $this->published_at,
        ];
    }
}
