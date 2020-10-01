<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const TYPE_ALERT    = 'alert';
    const TYPE_EVENT    = 'event';
    const TYPE_LOG      = 'log';

    use HasFactory;

    /**
     * @return string[]
     */
    public static function types()
    {
        return [
            self::TYPE_ALERT,
            self::TYPE_EVENT,
            self::TYPE_LOG,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shared',
        'type',
        'title',
        'url',
        'icon',
        'color',
        'badge',
        'message',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
