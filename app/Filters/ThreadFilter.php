<?php
namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilter extends Filter
{
    protected $filters = ['author'];

    public function author($authorName)
    {
        $author = User::where('name', $authorName)->firstOrFail();

        return $this->builder->where('author_id', $author->id);
    }
}
