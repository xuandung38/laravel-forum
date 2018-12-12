<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Thread extends Model
{
    protected static $activities = [
        'created'
    ];

    use Favouritable;
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['author'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function (Builder $builder) {
            $builder->withCount('replies');
        });

        // static::deleting(function($thread) {
        //     $thread->replies()->delete();
        // });
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

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
