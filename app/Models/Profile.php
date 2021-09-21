<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'name',
        'gender',
        'birthdate',
        'country',
        'town',
        'education_id',
        'place_of_study',
        'place_of_work',
        'post',
        'marital_status_id',
        'children',
        'habit_id',
        'about_me',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'birthdate' => 'date',
        'education_id' => 'integer',
        'marital_status_id' => 'integer',
        'children' => 'boolean',
        'habit_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function education()
    {
        return $this->belongsTo(\App\Models\Education::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(\App\Models\MaritalStatus::class);
    }

    public function habit()
    {
        return $this->belongsTo(\App\Models\Habit::class);
    }

}
