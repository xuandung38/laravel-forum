<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Thread;
use Illuminate\Database\Eloquent\Collection;
use App\Category;

class ThreadTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    public function test_that_a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    public function test_that_a_thread_has_an_author()
    {
        $this->assertInstanceOf(User::class, $this->thread->author);
    }

    public function test_that_a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foo',
            'author_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    public function test_that_a_thread_belongs_to_a_category()
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Category::class, $thread->category);
    }

    public function test_that_a_thread_can_create_a_representation_of_its_path()
    {
        $thread = create(Thread::class);

        $this->assertEquals('/threads/' . $thread->category->slug . '/' . $thread->id, $thread->path());
    }
}
