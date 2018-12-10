<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Thread;

class ProfileTest extends TestCase
{
    public function test_that_a_user_has_a_profile()
    {
        $user = create(User::class);

        $this
            ->get('/profiles/' . $user->name)
            ->assertSee($user->name);
    }

    public function test_that_a_users_profile_displays_their_threads()
    {
        $user = create(User::class);
        $thread = create(Thread::class, ['author_id' => $user->id]);

        $this
            ->get('/profiles/' . $user->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
