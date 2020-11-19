<?php

namespace App\Address;

use Illuminate\Database\Eloquent\Model;

class Components
{
    /**
     * @var \App\Models\Address\Country
     */
    public $country;

    /**
     * @var \App\Models\Address\Province
     */
    public $province;

    /**
     * @var \App\Models\Address\Area
     */
    public $area;

    /**
     * @var \App\Models\Address\Locality
     */
    public $locality;

    /**
     * @var \App\Models\Address\District
     */
    public $district;

    /**
     * @var \App\Models\Address\Metro
     */
    public $metro;

    /**
     * @var \App\Models\Address\Street
     */
    public $street;

    /**
     * @var \App\Models\Address\House
     */
    public $house;

    /**
     * @var \App\Models\Address\Entrance
     */
    public $entrance;

    /**
     * @var \App\Models\Address\Coordinates
     */
    public $coordinates;

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function applyToModel(Model $model)
    {
        $model->address_country_id = optional($this->country)->id;
        $model->address_province_id = optional($this->province)->id;
        $model->address_area_id = optional($this->area)->id;
        $model->address_locality_id = optional($this->locality)->id;
        $model->address_district_id = optional($this->district)->id;
        $model->address_metro_id = optional($this->metro)->id;
        $model->address_street_id = optional($this->street)->id;
        $model->address_house_id = optional($this->house)->id;
        $model->address_entrance_id = optional($this->entrance)->id;
        $model->address_coordinates_id = optional($this->coordinates)->id;

        $model->save();

        return $model;
    }
}
