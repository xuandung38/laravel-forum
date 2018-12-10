<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    /*
        Relationships
    */

    public function replies()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
        Relationship Helpers
    */

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    /*
        Form/View Helper Methods
    */

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
}
