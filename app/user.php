<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();;
    }
    
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
    

    public function userProfile()
    {
        return $this->hasOne('App\UserProfile');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
