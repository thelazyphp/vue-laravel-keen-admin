<?php

namespace App\Address;

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
}
