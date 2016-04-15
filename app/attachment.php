<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'desc', 'ctime', 'size',
        'extension', 'privilege', 'is_del', 'save_path', 'save_name',
        'url'
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
