<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTariff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tariff_id',
        'payment_amount',
        'finished_at',
        'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'tariff_id' => 'integer',
        'finished_at' => 'timestamp',
        'is_active'=>'boolean'
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function tariff()
    {
        return $this->belongsTo(\App\Models\Tariff::class);
    }

}
