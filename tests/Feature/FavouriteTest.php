<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Reply;
use App\Thread;

class FavouriteTest extends TestCase
{
    public function test_that_a_user_can_favourite_a_thread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post('/favourites/thread/' . $thread->id);

        // dd($thread->favourites);

        $this->assertCount(1, $thread->favourites);
    }

    public function test_that_a_user_can_favourite_a_reply()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->post('favourites/reply/' . $reply->id);

        $this->assertCount(1, $reply->favourites);
    }

    public function test_that_a_user_can_favourite_a_reply_only_once()
    {
        $this->signIn();

        $reply = create(Reply::class);

        // NOTE: Could throw because of constraint errors with certain DB drivers.
        try {
            $this->post('favourites/reply/' . $reply->id);
            $this->post('favourites/reply/' . $reply->id);
            $this->post('favourites/reply/' . $reply->id);
        } catch (\Exception $e) {
            $this->fail('Unique constraint failed.');
        }

        $this->assertCount(1, $reply->favourites);
    }

    public function test_that_a_guest_cannot_favourite_anything()
    {
        $this->post('/favourites/thread/1')
            ->assertRedirect('/login');

        $this->post('/favourites/reply/1')
            ->assertRedirect('/login');
    }
}
