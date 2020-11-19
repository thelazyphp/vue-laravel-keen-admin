<?php

namespace App\Address;

use App\Models\YandexGeocode;
use App\Address\Components;
use App\Models\Address\Country;
use App\Models\Address\Province;
use App\Models\Address\Area;
use App\Models\Address\Locality;
use App\Models\Address\District;
use App\Models\Address\Metro;
use App\Models\Address\Street;
use App\Models\Address\House;
use App\Models\Address\Entrance;
use App\Models\Address\Coordinates;

class Geocoder
{
    /**
     * @param  string  $request
     * @return \App\Address\Components
     */
    public function getAddressComponents($request)
    {
        $geocode = YandexGeocode::where([
            'request' => $request,
        ])->first();

        if (! $geocode) {
            $attributes = [
                'request' => $request,
            ];

            $apiKey = config('services.yandex.api_key');

            $request = rawurlencode($request);

            $data = json_decode(
                file_get_contents(
                    "https://geocode-maps.yandex.ru/1.x?format=json&apikey={$apiKey}&geocode={$request}"
                )
            );

            if (
                $data->response
                    ->GeoObjectCollection
                    ->metaDataProperty
                    ->GeocoderResponseMetaData
                    ->found
            ) {
                $geoObject = $data->response
                    ->GeoObjectCollection
                    ->featureMember[0]
                    ->GeoObject;

                foreach (
                    $geoObject->metaDataProperty
                        ->GeocoderMetaData
                        ->Address
                        ->Components as $addressComponent
                ) {
                    if (
                        $addressComponent->kind == 'area'
                        && mb_strpos($addressComponent->name, 'район') === false
                    ) {
                        continue;
                    }

                    $attributes[$addressComponent->kind] = $addressComponent->name;
                }

                [$attributes['long'], $attributes['lat']] = explode(
                    ' ', $geoObject->Point->pos, 2
                );
            }

            $geocode = YandexGeocode::create($attributes);
        }

        $components = new Components();

        if ($geocode->country) {
            $components->country = Country::firstOrCreate([
                'name' => $geocode->country,
            ]);
        }

        if ($geocode->province) {
            $attributes = [
                'name' => $geocode->province,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            $components->province = Province::firstOrCreate($attributes);
        }

        if ($geocode->area) {
            $attributes = [
                'name' => $geocode->area,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            $components->area = Area::firstOrCreate($attributes);
        }

        if ($geocode->locality) {
            $attributes = [
                'name' => $geocode->locality,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            $components->locality = Locality::firstOrCreate($attributes);
        }

        if ($geocode->district) {
            $attributes = [
                'name' => $geocode->district,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attributes['locality_id'] = $components->locality->id;
            }

            $components->district = District::firstOrCreate($attributes);
        }

        if ($geocode->metro) {
            $attributes = [
                'name' => $geocode->metro,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attributes['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attributes['district_id'] = $components->district->id;
            }

            $components->metro = Metro::firstOrCreate($attributes);
        }

        if ($geocode->street) {
            $attributes = [
                'name' => $geocode->street,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attributes['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attributes['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attributes['metro_id'] = $components->metro->id;
            }

            $components->street = Street::firstOrCreate($attributes);
        }

        if ($geocode->house) {
            $attributes = [
                'name' => $geocode->house,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attributes['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attributes['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attributes['metro_id'] = $components->metro->id;
            }

            if ($components->street) {
                $attributes['street_id'] = $components->street->id;
            }

            $components->house = House::firstOrCreate($attributes);
        }

        if ($geocode->entrance) {
            $attributes = [
                'name' => $geocode->entrance,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attributes['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attributes['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attributes['metro_id'] = $components->metro->id;
            }

            if ($components->street) {
                $attributes['street_id'] = $components->street->id;
            }

            $components->entrance = Entrance::firstOrCreate($attributes);
        }

        if ($geocode->lat && $geocode->long) {
            $attributes = [
                'lat' => $geocode->lat,
                'long' => $geocode->long,
            ];

            if ($components->country) {
                $attributes['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attributes['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attributes['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attributes['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attributes['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attributes['metro_id'] = $components->metro->id;
            }

            if ($components->street) {
                $attributes['street_id'] = $components->street->id;
            }

            if ($components->entrance) {
                $attributes['entrance_id'] = $components->entrance->id;
            }

            $components->coordinates = Coordinates::firstOrCreate($attributes);
        }

        return $components;
    }
}
