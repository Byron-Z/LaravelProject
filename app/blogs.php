<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'blogs_uid', 'content', 'post_time', 'reply_count', 
        'read_count', 'last_change_time', 'is_del'
    ];

    public function user()
    {
        return $this->belongsTo('App\users', 'foreign_key');
    }

    public function reply()
    {
        return $this->hasMany('App\replies');
    }

    public function attachment()
    {
        return $this->belongsToMany('App\attachments');
    }
}
