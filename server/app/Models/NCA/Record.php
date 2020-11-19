<?php

namespace App\Models\NCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nca_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'inventory_number',
        'address_country_id',
        'address_province_id',
        'address_area_id',
        'address_locality_id',
        'address_district_id',
        'address_metro_id',
        'address_street_id',
        'address_house_id',
        'address_entrance_id',
        'address_coordinates_id',
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
        'price_sq_m_byn',
        'price_description',
        'price_usd',
        'price_sq_m_usd',
        'price_eur',
        'price_sq_m_eur',
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
        'size' => 'float',
        'entry_date' => 'datetime',
        'transaction_date' => 'datetime',
        'objects_count' => 'integer',
        'price_byn' => 'float',
        'price_sq_m_byn' => 'float',
        'price_usd' => 'float',
        'price_sq_m_usd' => 'float',
        'price_eur' => 'float',
        'price_sq_m_eur' => 'float',
        'contract_price_amount' => 'float',
        'rooms' => 'integer',
        'floor' => 'integer',
        'capital_size' => 'float',
        'capital_ready_percentage' => 'integer',
        'capital_floors' => 'integer',
        'capital_underground_floors' => 'integer',
        'land_size' => 'float',
    ];

    /**
     * @return void
     */
    public function type()
    {
        return $this->belongsTo(
            'App\Models\NCA\RecordType', 'type_id'
        );
    }

    /**
     * @return void
     */
    public function function()
    {
        return $this->belongsTo(
            'App\Models\NCA\RecordFunction', 'function_id'
        );
    }

    /**
     *
     */
    public function country()
    {
        return $this->belongsTo(
            'App\Models\Address\Country', 'address_country_id'
        );
    }

    /**
     *
     */
    public function province()
    {
        return $this->belongsTo(
            'App\Models\Address\Province', 'address_province_id'
        );
    }

    /**
     *
     */
    public function area()
    {
        return $this->belongsTo(
            'App\Models\Address\Area', 'address_area_id'
        );
    }

    /**
     *
     */
    public function locality()
    {
        return $this->belongsTo(
            'App\Models\Address\Locality', 'address_locality_id'
        );
    }

    /**
     *
     */
    public function district()
    {
        return $this->belongsTo(
            'App\Models\Address\District', 'address_district_id'
        );
    }

    /**
     *
     */
    public function metro()
    {
        return $this->belongsTo(
            'App\Models\Address\Metro', 'address_metro_id'
        );
    }

    /**
     *
     */
    public function street()
    {
        return $this->belongsTo(
            'App\Models\Address\Street', 'address_street_id'
        );
    }

    /**
     *
     */
    public function house()
    {
        return $this->belongsTo(
            'App\Models\Address\House', 'address_house_id'
        );
    }

    /**
     *
     */
    public function entrance()
    {
        return $this->belongsTo(
            'App\Models\Address\Entrance', 'address_entrance_id'
        );
    }

    /**
     *
     */
    public function coordinates()
    {
        return $this->belongsTo(
            'App\Models\Address\Coordinates', 'address_coordinates_id'
        );
    }
}
