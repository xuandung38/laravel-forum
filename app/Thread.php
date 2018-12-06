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
        return $this->pathWithCategory();
    }

    public function pathWithCategory()
    {
        return "/threads/{$this->category->slug}/{$this->id}";
    }

    public function pathWithoutCategory($withReplies = false)
    {
        $path = "/threads/{$this->id}";

        return $withReplies ? $path . '/replies' : $path;
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
