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
        'owner_id',
        'name',
    ];

    public function owner()
    {
        return $this->belongsTo(
            'App\Models\User', 'owner_id'
        );
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
