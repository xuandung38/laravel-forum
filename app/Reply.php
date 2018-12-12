<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected static $activities = [
        'created'
    ];

    use Favouritable;
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['author', 'favourites'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->parent->path() . '#reply-' . $this->id;
    }
}
