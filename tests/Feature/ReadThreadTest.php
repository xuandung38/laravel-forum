<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Reply;
use App\Thread;
use App\Category;

class ReadThreadTest extends TestCase
{
    // public function setUp()
    // {
    //     parent::setUp();

    //     $this->thread = factory(Thread::class)->create();
    // }

    public function test_that_a_user_can_view_all_threads()
    {
        $thread = create(Thread::class);

        $response = $this
            ->get('/threads')
            ->assertStatus(200)
            ->assertSee($thread->title);
    }

    public function test_that_a_user_can_view_a_specific_thread()
    {
        $thread = create(Thread::class);

        $response = $this
            ->get($thread->path())
            ->assertStatus(200)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_that_a_user_can_see_the_replies_to_a_thread()
    {
        $thread = create(Thread::class);
        $reply = create(Reply::class, ['parent_id' => $thread->id]);

        $this
            ->get($thread->path())
            ->assertStatus(200)
            ->assertSee($reply->body);
    }

    public function a_user_can_view_threads_belonging_to_a_category()
    {
        $category = create(Category::class);
        $threadInCategory = create(Thread::class, ['category_id' => $category->id]);
        $threadNotInCategory = create(Thread::class);

        $this
            ->get('/threads/' . $category->slug)
            ->assertSee($threadInCategory->title)
            ->assertNotSee($threadNotInCategory->title);
    }
}
