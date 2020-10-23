<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'admin' => true,
        'employee' => false,
        'locale' => 'en',
        'timezone' => 'UTC',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'admin',
        'employee',
        'image_id',
        'name',
        'email',
        'password',
        'locale',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'admin' => 'boolean',
        'employee' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the image record associated with the user.
     */
    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }

    /**
     * Get the company that owns the user.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
