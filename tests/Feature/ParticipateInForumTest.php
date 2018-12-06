<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Thread;
use App\Reply;
use Illuminate\Auth\AuthenticationException;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_that_an_unauthenticated_user_cannot_reply_to_a_forum_thread()
    {
        // $this->expectException(AuthenticationException::class);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();

        try {
            $response = $this->post('/threads/1/replies', $reply->toArray());
        } catch (\Exception $e) {
            \Log::debug($e->getMessage());
        }
        $response->assertStatus(302);
        $response->assertRedirect('login');

        $response = $this->get('/threads/1');
    }

    public function test_that_an_authenticated_user_may_reply_to_a_forum_thread()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make();

        $response = $this->post('/threads/1/replies', $reply->toArray());
        $response->assertStatus(302);

        $response = $this->get('/threads/1');
        $response->assertSee($reply->body);
    }
}
