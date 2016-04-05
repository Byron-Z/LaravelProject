<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'count'
    ];

    public function articles()
    {
        return $this->hasMany('App\articles');
    }
}
