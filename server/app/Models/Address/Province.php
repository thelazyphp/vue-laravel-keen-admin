<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_provinces';

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
    ];

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
    public function areas()
    {
        return $this->hasMany(
            'App\Models\Address\Area', 'province_id'
        );
    }

    /**
     *
     */
    public function localities()
    {
        return $this->hasMany(
            'App\Models\Address\Locality', 'province_id'
        );
    }

    /**
     *
     */
    public function districts()
    {
        return $this->hasMany(
            'App\Models\Address\District', 'province_id'
        );
    }

    /**
     *
     */
    public function metros()
    {
        return $this->hasMany(
            'App\Models\Address\Metro', 'province_id'
        );
    }

    /**
     *
     */
    public function streets()
    {
        return $this->hasMany(
            'App\Models\Address\Street', 'province_id'
        );
    }

    /**
     *
     */
    public function houses()
    {
        return $this->hasMany(
            'App\Models\Address\House', 'province_id'
        );
    }

    /**
     *
     */
    public function entrances()
    {
        return $this->hasMany(
            'App\Models\Address\Entrance', 'province_id'
        );
    }
}
