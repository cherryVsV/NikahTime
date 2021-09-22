<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable, HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'phone',
        'email',
        'password',
        'blocked_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'blocked_at' => 'datetime',
    ];
    public function chats()
    {
        return $this->HasMany(\App\Models\Chat::class);
    }
    public function likes()
    {
        return $this->HasMany(\App\Models\Like::class);
    }
    public function messages()
    {
        return $this->HasMany(\App\Models\Message::class);
    }
    public function profile()
    {
        return $this->HasOne(\App\Models\Profile::class);
    }
    public function socialAccount()
    {
        return $this->HasMany(\App\Models\SocialAccount::class);
    }
    public function questions()
    {
        return $this->HasMany(\App\Models\Question::class);
    }
    public function userTariffs()
    {
        return $this->hasMany(\App\Models\UserTariff::class);
    }
    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class);
    }
    public function authAccessToken(){
        return $this->hasMany(OauthAccessToken::class);
    }
}
