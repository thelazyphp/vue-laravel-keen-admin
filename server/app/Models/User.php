<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_EMPLOYEE = 'employee';

    use HasFactory, Notifiable, HasApiTokens;

    /**
     * @return string[]
     */
    public static function roles()
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_MANAGER,
            self::ROLE_EMPLOYEE,
        ];
    }

    /**
     * @return string[]
     */
    public static function fillableRoles()
    {
        return [
            self::ROLE_MANAGER,
            self::ROLE_EMPLOYEE,
        ];
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
        'role' => self::ROLE_ADMIN,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'image_id',
        'active',
        'role',
        'f_name',
        'm_name',
        'l_name',
        'email',
        'phone',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * @return void
     */
    public function activate()
    {
        $this->active = true;
        $this->save();
    }

    /**
     * @return void
     */
    public function deactivate()
    {
        $this->active = false;
        $this->save();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isManager()
    {
        return $this->role == self::ROLE_MANAGER;
    }

    /**
     * @return bool
     */
    public function isEmployee()
    {
        return $this->role == self::ROLE_EMPLOYEE;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany('App\Models\Request');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany('App\Models\Ad', 'favorites')->withTimestamps();
    }
}
