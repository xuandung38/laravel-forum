<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Reply;
use App\Thread;

class ReadThreadTest extends TestCase
{
    use RefreshDatabase;

    // public function setUp()
    // {
    //     parent::setUp();

    //     $this->thread = factory(Thread::class)->create();
    // }

    public function test_that_a_user_can_view_all_threads()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('/threads')
            ->assertStatus(200)
            ->assertSee($thread->title);
    }

    public function test_that_a_user_can_view_a_specific_thread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('/threads/' . $thread->id)
            ->assertStatus(200)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_that_a_user_can_see_the_replies_to_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->create(['parent_id' => $thread->id]);

        $this->get('/threads/' . $thread->id)
            ->assertStatus(200)
            ->assertSee($reply->body);
    }
}
