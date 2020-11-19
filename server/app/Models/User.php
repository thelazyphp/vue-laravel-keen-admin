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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
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
        'email_verified_at' => 'datetime',
    ];

    /**
     *
     */
    public function image()
    {
        return $this->hasOne('App\Models\UserImage');
    }

    /**
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     *
     */
    public function employees()
    {
        return $this->company
            ->users()
            ->where(
                'id', '<>', $this->id
            );
    }

    /**
     * @return bool
     */
    public function isCompanyOwner()
    {
        return $this->id === $this->company->owner->id;
    }
}
