<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    const TRANSACTION_SELL = 'sell';
    const TRANSACTION_RENT = 'rent';

    const CATEGORY_APARTMENTS = 'apartments';
    const CATEGORY_HOUSES = 'houses';
    const CATEGORY_COMMERCIAL_REAL_ESTATE = 'commercial_real_estate';

    use HasFactory;

    /**
     * @return string[]
     */
    public static function transactions()
    {
        return [
            self::TRANSACTION_SELL,
            self::TRANSACTION_RENT,
        ];
    }

    /**
     * @return string[]
     */
    public static function categories()
    {
        return [
            self::CATEGORY_APARTMENTS,
            self::CATEGORY_HOUSES,
            self::CATEGORY_COMMERCIAL_REAL_ESTATE,
        ];
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'transaction' => self::TRANSACTION_SELL,
        'images' => '[]',
        'price_history' => '[]',
        'price_currency' => 'USD',
        'price_sq_m_history' => '[]',
        'price_sq_m_currency' => 'USD',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller_id',
        'transaction',
        'category',
        'type',
        'source',
        'url',
        'images',
        'title',
        'full_address',
        'address_country',
        'address_province',
        'address_area',
        'address_locality',
        'address_district',
        'address_microdistrict',
        'address_street',
        'address_house',
        'address_coordinates_lat',
        'address_coordinates_long',
        'rooms',
        'floor',
        'floors',
        'year_built',
        'size_land',
        'size_total',
        'size_living',
        'size_kitchen',
        'roof',
        'walls',
        'balcony',
        'bathroom',
        'price_history',
        'price_amount',
        'price_currency',
        'price_sq_m_history',
        'price_sq_m_amount',
        'price_sq_m_currency',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array',
        'rooms' => 'integer',
        'floor' => 'integer',
        'floors' => 'integer',
        'year_built' => 'integer',
        'size_land' => 'float',
        'size_total' => 'float',
        'size_living' => 'float',
        'size_kitchen' => 'float',
        'price_history' => 'array',
        'price_amount' => 'integer',
        'price_sq_m_history' => 'array',
        'price_sq_m_amount' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo('App\Models\Seller');
    }

    /**
     * @return bool
     */
    public function isFavorite()
    {
        return Favorite::where('user_id', auth()->id())->where('ad_id', $this->id)->exists();
    }
}
