<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    public function articles()
    {
        return $this->hasMany('App\articles');
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
