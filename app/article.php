<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
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
        return $this->belongsTo('App\User', 'foreign_key');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
