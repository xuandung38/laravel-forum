<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Thread;
use App\Reply;

use Illuminate\Auth\AuthenticationException;

class ReplyToThreadTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_that_an_unauthenticated_user_cannot_reply_to_a_forum_thread()
    {
        $this->expectException(AuthenticationException::class);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();

        $this->post('/threads/1/replies', $reply->toArray());
    }

    public function test_that_an_authenticated_user_may_reply_to_a_forum_thread()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();

        $this->post('/threads/1/replies', $reply->toArray())
            ->assertStatus(302);

        $this->get('/threads/1')
            ->assertSee($reply->body);
    }
}
