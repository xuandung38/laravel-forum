<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favouritable;

    protected $guarded = [];

    protected $with = ['author', 'favourites'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
