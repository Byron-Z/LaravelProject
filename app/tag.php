<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tag_uid', 'count'
    ];

    public function articles()
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }
}
