<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'parsing' => false,
        'active' => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'parsing',
        'active',
        'public',
        'name',
        'url',
        'image',
        'description',
        'last_time_parsed_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'parsing' => 'boolean',
        'active' => 'boolean',
        'public' => 'boolean',
        'last_time_parsed_at' => 'datetime',
    ];

    /**
     * Get the category that owns the group.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
