<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'article_id', 'article_uid', 'content', 'to_reply_id', 
        'is_del'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }

    public function article()
    {
        return $this->belongsTo('App\Article', 'foreign_key');
    }
}
