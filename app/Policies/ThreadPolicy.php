<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Thread;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->name === 'sustained') {
            return true;
        }
    }

    public function update(User $user, Thread $thread)
    {
        return $thread->author->id == $user->id;
    }
}
