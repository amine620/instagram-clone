<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }

    public function can_comment()
    {
        return $this->belongsToMany(Post::class,'comments','user_id','post_id')->withTimestamps();
    }
    public function can_like()
    {
        return $this->belongsToMany(Post::class,'likes','user_id','post_id')->withTimestamps();
    }

    public function can_follow_users()
    {
        return $this->belongsToMany(User::class,'follow','user_id_1','user_id_2')->withTimestamps();

    }
    public function can_be_followed()
    {
        return $this->belongsToMany(User::class,'follow','user_id_2','user_id_1')->withTimestamps();

    }
  
}
