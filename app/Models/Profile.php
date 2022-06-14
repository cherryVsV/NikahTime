<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

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
        'photos',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'contact_phone_number',
        'country',
        'city',
        'education_id',
        'place_of_study',
        'place_of_work',
        'work_position',
        'marital_status_id',
        'have_children',
        'about',
        'nationality'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'birth_date' => 'datetime',
        'education_id' => 'integer',
        'marital_status_id' => 'integer',
        'have_children' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $user = User::find($item->user_id);
            if($user){
                $user->delete();
            }
        });

    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function habits()
    {
        return $this->belongsToMany(\App\Models\Habit::class, 'profile_habit');
    }

    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class, 'profile_interest');
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->user_id);
    }
}
