<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\User;
use App\Thread;
use App\Reply;

use Illuminate\Auth\AuthenticationException;

class ReplyToThreadTest extends TestCase
{
    public function test_that_an_unauthenticated_user_cannot_reply_to_a_forum_thread()
    {
        $thread = create(Thread::class);
        $reply = make(Reply::class);

        $this
            ->withoutExceptionHandling()
            ->expectException(AuthenticationException::class);

        $this->post('/threads/1/replies', $reply->toArray());
    }

    public function test_that_a_user_can_reply_to_a_forum_thread()
    {
        $thread = create(Thread::class);
        $reply = make(Reply::class);

        $this
            ->signIn()
            ->post('/threads/1/replies', $reply->toArray())
            ->assertStatus(302);

        $this->get('/threads/some-category/1')
            ->assertSee($reply->body);
    }

    public function test_that_a_reply_requires_a_body()
    {
        $this
            ->signIn();

        $thread = create(Thread::class);
        $reply = make(Reply::class, ['body' => null]);

        $this
            ->post($thread->pathWithoutCategory(true), $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
