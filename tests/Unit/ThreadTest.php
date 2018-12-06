<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Thread;
use Illuminate\Database\Eloquent\Collection;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

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
}
