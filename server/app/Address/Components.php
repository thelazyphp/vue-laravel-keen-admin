<?php

namespace App\Address;

class Components
{
    /**
     * @var float
     */
    public $lat;

    /**
     * @var float
     */
    public $long;

    /**
     * @var \App\Models\Address\Components\Country|null
     */
    public $country;

    /**
     * @var \App\Models\Address\Components\Province|null
     */
    public $province;

    /**
     * @var \App\Models\Address\Components\Area|null
     */
    public $area;

    /**
     * @var \App\Models\Address\Components\Locality|null
     */
    public $locality;

    /**
     * @var \App\Models\Address\Components\District|null
     */
    public $district;

    /**
     * @var \App\Models\Address\Components\Metro|null
     */
    public $metro;

    /**
     * @var \App\Models\Address\Components\Street|null
     */
    public $street;

    /**
     * @var \App\Models\Address\Components\House|null
     */
    public $house;

    /**
     * @var \App\Models\Address\Components\Entrance|null
     */
    public $entrance;

    /**
     * @param  float  $lat
     * @param  float  $long
     */
    public function __construct($lat, $long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }
}
