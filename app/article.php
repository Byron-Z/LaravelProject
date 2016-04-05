<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'article_id', 'content', 'post_time', 'comment_count', 
        'read_count', 'last_change_time', 'is_del'
    ];

    public function user()
    {
        return $this->belongsTo('App\users', 'foreign_key');
    }

    public function comments()
    {
        return $this->hasMany('App\comments');
    }

    public function attachments()
    {
        return $this->hasMany('App\attachments');
    }

    public function tags()
    {
        return $this->hasMany('App\tags');
    }
}
