<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'article_id', 'article_uid', 'content', 'ctime', 'to_reply_id', 
        'is_del'
    ];

    public function user()
    {
        return $this->belongsTo('App\users', 'foreign_key');
    }

    public function article()
    {
        return $this->belongsTo('App\articles', 'foreign_key');
    }
}
