<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'create_users' => false,
        'update_users' => false,
        'delete_users' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'create_users',
        'update_users',
        'delete_users',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'create_users' => 'boolean',
        'update_users' => 'boolean',
        'delete_users' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
