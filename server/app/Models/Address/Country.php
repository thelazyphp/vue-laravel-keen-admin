<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_countries';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     *
     */
    public function provinces()
    {
        return $this->hasMany(
            'App\Models\Address\Province', 'country_id'
        );
    }

    /**
     *
     */
    public function areas()
    {
        return $this->hasMany(
            'App\Models\Address\Area', 'country_id'
        );
    }

    /**
     *
     */
    public function localities()
    {
        return $this->hasMany(
            'App\Models\Address\Locality', 'country_id'
        );
    }

    /**
     *
     */
    public function districts()
    {
        return $this->hasMany(
            'App\Models\Address\District', 'country_id'
        );
    }

    /**
     *
     */
    public function metros()
    {
        return $this->hasMany(
            'App\Models\Address\Metro', 'country_id'
        );
    }

    /**
     *
     */
    public function streets()
    {
        return $this->hasMany(
            'App\Models\Address\Street', 'country_id'
        );
    }

    /**
     *
     */
    public function houses()
    {
        return $this->hasMany(
            'App\Models\Address\House', 'country_id'
        );
    }

    /**
     *
     */
    public function entrances()
    {
        return $this->hasMany(
            'App\Models\Address\Entrance', 'country_id'
        );
    }
}
