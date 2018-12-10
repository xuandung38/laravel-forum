<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// FIXME: Favourites aren't deleted when threads/replies are.
class Favourite extends Model
{
    protected $guarded = [];

    protected $table = 'favourites';
}
