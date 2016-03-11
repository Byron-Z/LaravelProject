<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'blogs_id', 'blogs_uid', 'content', 'ctime', 'to_reply_id', 
        'to_reply_uid', 'is_del'
    ];

    public function user()
    {
        return $this->belongsTo('App\users', 'foreign_key', 'uid');
    }

    public function blogUser()
    {
        return $this->belongsTo('App\users', 'foreign_key', 'blogs_uid');
    }

    public function replyUser()
    {
        return $this->belongsTo('App\users', 'foreign_key', 'to_reply_uid');
    }

    public function blog()
    {
        return $this->belongsTo('App\blogs', 'foreign_key');
    }
}
