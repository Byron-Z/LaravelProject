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
        'title', 'article_uid', 'content', 'comment_count', 
        'read_count', 'is_del', 'comment_permition', 'is_public', 'reproduct_permition', 'type',
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
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
