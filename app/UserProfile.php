<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = [
        'user_id', 'phone', 'sex', 'city', 'country',
        'discription',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
