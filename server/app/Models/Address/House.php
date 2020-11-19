<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_houses';

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
        'locality_id',
        'district_id',
        'metro_id',
        'street_id',
    ];

    /**
     *
     */
    public function street()
    {
        return $this->belongsTo(
            'App\Models\Address\Street', 'street_id'
        );
    }

    /**
     *
     */
    public function metro()
    {
        return $this->belongsTo(
            'App\Models\Address\Metro', 'metro_id'
        );
    }

    /**
     *
     */
    public function district()
    {
        return $this->belongsTo(
            'App\Models\Address\District', 'district_id'
        );
    }

    /**
     *
     */
    public function locality()
    {
        return $this->belongsTo(
            'App\Models\Address\Locality', 'locality_id'
        );
    }

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
    public function entrances()
    {
        return $this->hasMany(
            'App\Models\Address\Entrance', 'house_id'
        );
    }
}
