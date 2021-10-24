<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'chat_id',
        'message',
        'receiver_id',
        'is_seen',
        'type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'chat_id' => 'integer',
        'receiver_id' => 'integer',
        'is_seen'=>'boolean'
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function chat()
    {
        return $this->belongsTo(\App\Models\Chat::class);
    }

}
