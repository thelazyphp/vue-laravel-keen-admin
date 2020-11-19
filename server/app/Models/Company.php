<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     *
     */
    public function owner()
    {
        return $this->hasOne(
            'App\Models\User', 'owner_id'
        );
    }

    /**
     *
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
