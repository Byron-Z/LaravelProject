<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sex', 'city', 'country', 'create_time',
        'phone', 'last_login_time', 'last_post_time'
    ];

    public function blogs()
    {
        return $this->hasMany('App\blogs');
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
