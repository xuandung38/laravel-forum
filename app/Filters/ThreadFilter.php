<?php
namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilter extends Filter
{
    protected $filters = [
        'author',
        'popular'
    ];

    public function author($authorName)
    {
        $author = User::where('name', $authorName)->firstOrFail();

        return $this->builder->where('author_id', $author->id);
    }

    public function popular($authorName)
    {
        return $this->builder->orderBy('replies_count', 'desc');
    }
}
