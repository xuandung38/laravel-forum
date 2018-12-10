<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use App\Favourite;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeReply(Reply $reply)
    {
        $reply->favourite();

        return back();
    }

    public function storeThread(Thread $thread)
    {
        $thread->favourite();

        return back();
    }
}
