<?php

namespace App\Address;

use App\Models\GeocodeCacheRecord;
use App\Models\Address\Components\Country;
use App\Models\Address\Components\Province;
use App\Models\Address\Components\Area;
use App\Models\Address\Components\Locality;
use App\Models\Address\Components\District;
use App\Models\Address\Components\Metro;
use App\Models\Address\Components\Street;
use App\Models\Address\Components\House;
use App\Models\Address\Components\Entrance;

class Resolver
{
    /**
     * @var bool
     */
    protected $geocodeMetro = true;

    /**
     * @var string[]
     */
    protected $localitiesHasMetro = [];

    /**
     * @param  bool  $geocodeMetro
     * @param  string[]  $localitiesHasMetro
     */
    public function __construct($geocodeMetro = true, $localitiesHasMetro = [])
    {
        $this->geocodeMetro = $geocodeMetro;

        $this->localitiesHasMetro = $localitiesHasMetro;
    }

    /**
     * @param  string  $request
     * @return \App\Address\Components|null
     */
    public function resolveAddressComponents($request)
    {
        $cacheRecord = GeocodeCacheRecord::where('request', $request)->first();

        if (! $cacheRecord) {
            $attrs = [
                'request' => $request,
            ];

            $apiKey = config('services.yandex.api_key');

            $request = rawurlencode($request);

            $data = json_decode(
                file_get_contents(
                    "https://geocode-maps.yandex.ru/1.x?format=json&apikey={$apiKey}&geocode={$request}"
                )
            );

            if ($data->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found) {
                $geoObject = $data->response->GeoObjectCollection->featureMember[0]->GeoObject;

                foreach ($geoObject->metaDataProperty->GeocoderMetaData->Address->Components as $component) {
                    if ($component->kind == 'area' && mb_strpos($component->name, 'район') === false) {
                        continue;
                    }

                    $attrs[$component->kind] = $component->name;
                }

                [$attrs['long'], $attrs['lat']] = explode(' ', $geoObject->Point->pos, 2);

                if (
                    $this->geocodeMetro
                    && ! isset($attrs['metro'])
                    && isset($attrs['locality'])
                    && (empty($this->localitiesHasMetro) || in_array($attrs['locality'], $this->localitiesHasMetro))
                ) {
                    $request = implode(
                        ',', [$attrs['long'], $attrs['lat']]
                    );

                    $data = json_decode(
                        file_get_contents(
                            "https://geocode-maps.yandex.ru/1.x?format=json&apikey={$apiKey}&geocode={$request}&kind=metro"
                        )
                    );

                    if ($data->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found) {
                        $geoObject = $data->response->GeoObjectCollection->featureMember[0]->GeoObject;

                        foreach ($geoObject->metaDataProperty->GeocoderMetaData->Address->Components as $component) {
                            if ($component->kind == 'metro') {
                                $attrs[$component->kind] = $component->name;
                            }
                        }
                    }
                }
            } else {
                return null;
            }

            $cacheRecord = GeocodeCacheRecord::create($attrs);
        }

        $components = new Components(
            $cacheRecord->lat, $cacheRecord->long
        );

        if ($cacheRecord->country) {
            $components->country = Country::firstOrCreate([
                'name' => $cacheRecord->country,
            ]);
        }

        if ($cacheRecord->province) {
            $attrs = [
                'name' => $cacheRecord->province,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            $components->province = Province::firstOrCreate($attrs);
        }

        if ($cacheRecord->area) {
            $attrs = [
                'name' => $cacheRecord->area,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            $components->area = Area::firstOrCreate($attrs);
        }

        if ($cacheRecord->locality) {
            $attrs = [
                'name' => $cacheRecord->locality,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attrs['area_id'] = $components->area->id;
            }

            $components->locality = Locality::firstOrCreate($attrs);
        }

        if ($cacheRecord->district) {
            $attrs = [
                'name' => $cacheRecord->district,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attrs['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attrs['locality_id'] = $components->locality->id;
            }

            $components->district = District::firstOrCreate($attrs);
        }

        if ($cacheRecord->metro) {
            $attrs = [
                'name' => $cacheRecord->metro,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attrs['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attrs['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attrs['district_id'] = $components->district->id;
            }

            $components->metro = Metro::firstOrCreate($attrs);
        }

        if ($cacheRecord->street) {
            $attrs = [
                'name' => $cacheRecord->street,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attrs['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attrs['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attrs['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attrs['metro_id'] = $components->metro->id;
            }

            $components->street = Street::firstOrCreate($attrs);
        }

        if ($cacheRecord->house) {
            $attrs = [
                'name' => $cacheRecord->house,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attrs['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attrs['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attrs['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attrs['metro_id'] = $components->metro->id;
            }

            if ($components->street) {
                $attrs['street_id'] = $components->street->id;
            }

            $components->house = House::firstOrCreate($attrs);
        }

        if ($cacheRecord->entrance) {
            $attrs = [
                'name' => $cacheRecord->entrance,
            ];

            if ($components->country) {
                $attrs['country_id'] = $components->country->id;
            }

            if ($components->province) {
                $attrs['province_id'] = $components->province->id;
            }

            if ($components->area) {
                $attrs['area_id'] = $components->area->id;
            }

            if ($components->locality) {
                $attrs['locality_id'] = $components->locality->id;
            }

            if ($components->district) {
                $attrs['district_id'] = $components->district->id;
            }

            if ($components->metro) {
                $attrs['metro_id'] = $components->metro->id;
            }

            if ($components->street) {
                $attrs['street_id'] = $components->street->id;
            }

            $components->entrance = Entrance::firstOrCreate($attrs);
        }

        return $components;
    }
}
