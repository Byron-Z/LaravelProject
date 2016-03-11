<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attachments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'type', 'desc', 'ctime', 'status', 'size',
        'extension', 'private', 'is_del', 'save_path', 'save_name',
        'url', 'width', 'height'
    ];

    public function blog()
    {
        return $this->belongsToMany('App\blogs');
    }
}
