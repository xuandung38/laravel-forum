<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Thread extends Model
{
    use Favouritable;

    protected $guarded = [];

    protected $with = ['author', 'category'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function (Builder $builder) {
            $builder->withCount('replies');
        });
    }

    /*
        Relationships
     */

    public function replies()
    {
        return $this->hasMany(Reply::class, 'parent_id')
            ->withCount('favourites')
            ->with('author');
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
