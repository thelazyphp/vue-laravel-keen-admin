<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QueryFilterable;

class CadastralRecord extends Model
{
    use HasFactory, QueryFilterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'inventory_number',
        'country_id',
        'province_id',
        'area_id',
        'locality_id',
        'district_id',
        'metro_id',
        'street_id',
        'house_id',
        'entrance_id',
        'lat',
        'long',
        'function_id',
        'function_description',
        'name',
        'size',
        'walls',
        'entry_date',
        'transaction_date',
        'transaction_id',
        'objects_count',
        'price_byn',
        'price_sqm_byn',
        'price_description',
        'price_usd',
        'price_sqm_usd',
        'price_eur',
        'price_sqm_eur',
        'contract_price_amount',
        'contract_price_currency',
        'pieces_before_transaction',
        'pieces_after_transaction',
        'rooms',
        'floor',
        'capital_inventory_number',
        'capital_size',
        'capital_function',
        'capital_function_description',
        'capital_name',
        'capital_ready_percentage',
        'capital_floors',
        'capital_underground_floors',
        'extra_objects',
        'land_cadastral_number',
        'land_function',
        'land_size',
        'ate_unique_number',
        'markers',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'lat' => 'float',
        'long' => 'float',
        'size' => 'float',
        'entry_date' => 'date',
        'transaction_date' => 'date',
        'objects_count' => 'integer',
        'price_byn' => 'float',
        'price_sqm_byn' => 'float',
        'price_usd' => 'float',
        'price_sqm_usd' => 'float',
        'price_eur' => 'float',
        'price_sqm_eur' => 'float',
        'contract_price_amount' => 'float',
        'rooms' => 'integer',
        'floor' => 'integer',
        'capital_size' => 'float',
        'capital_ready_percentage' => 'integer',
        'capital_floors' => 'integer',
        'capital_underground_floors' => 'integer',
        'land_size' => 'float',
    ];

    public function type()
    {
        return $this->belongsTo(
            'App\Models\CadastralRecordType', 'type_id'
        );
    }

    public function function()
    {
        return $this->belongsTo(
            'App\Models\CadastralRecordFunction', 'function_id'
        );
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Address\Components\Country');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Address\Components\Province');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Address\Components\Area');
    }

    public function locality()
    {
        return $this->belongsTo('App\Models\Address\Components\Locality');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Address\Components\District');
    }

    public function metro()
    {
        return $this->belongsTo('App\Models\Address\Components\Metro');
    }

    public function street()
    {
        return $this->belongsTo('App\Models\Address\Components\Street');
    }

    public function house()
    {
        return $this->belongsTo('App\Models\Address\Components\House');
    }

    public function entrance()
    {
        return $this->belongsTo('App\Models\Address\Components\Entrance');
    }
}
