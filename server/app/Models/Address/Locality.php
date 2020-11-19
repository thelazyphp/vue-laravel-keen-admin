<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_localities';

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
        'country_id',
        'province_id',
        'area_id',
    ];

    /**
     *
     */
    public function area()
    {
        return $this->belongsTo(
            'App\Models\Address\Area', 'area_id'
        );
    }

    /**
     *
     */
    public function province()
    {
        return $this->belongsTo(
            'App\Models\Address\Province', 'province_id'
        );
    }

    /**
     *
     */
    public function country()
    {
        return $this->belongsTo(
            'App\Models\Address\Country', 'country_id'
        );
    }

    /**
     *
     */
    public function districts()
    {
        return $this->hasMany(
            'App\Models\Address\District', 'locality_id'
        );
    }

    /**
     *
     */
    public function metros()
    {
        return $this->hasMany(
            'App\Models\Address\Metro', 'locality_id'
        );
    }

    /**
     *
     */
    public function streets()
    {
        return $this->hasMany(
            'App\Models\Address\Street', 'locality_id'
        );
    }

    /**
     *
     */
    public function houses()
    {
        return $this->hasMany(
            'App\Models\Address\House', 'locality_id'
        );
    }

    /**
     *
     */
    public function entrances()
    {
        return $this->hasMany(
            'App\Models\Address\Entrance', 'locality_id'
        );
    }
}
