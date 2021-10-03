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
        'name',
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

    public function authAccessToken(){
        return $this->hasMany(OauthAccessToken::class);
    }


    public function findForPassport($username){

        if($this->where('email',$username)->exists()){
            return $this->where('email',$username)->first();
        }
        if($this->where('phone',$username)->exists()){
            return $this->where('phone',$username)->first();
        }
        if(SocialAccount::where('provider_id', $username)->exists()){
            $social = SocialAccount::where('provider_id', $username)->first();
           return $this->where('id',$social->user_id)->first();
        }

    }
}
