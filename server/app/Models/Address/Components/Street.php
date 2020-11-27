<?php

namespace App\Models\Address\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QueryFilterable;

class Street extends Model
{
    use HasFactory, QueryFilterable;

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
    ];
}
