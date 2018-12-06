<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function path()
    {
        return '/threads/' + $this->id;
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
