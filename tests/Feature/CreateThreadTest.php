<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\User;
use App\Thread;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;

class CreateThreadTest extends TestCase
{
    public function test_that_a_guest_cannot_create_a_new_thread()
    {
        $this
            ->post('/threads')
            ->assertRedirect('/login');

        $this
            ->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_that_a_user_can_create_a_new_thread()
    {
        $thread = make(Thread::class);

        $this
            ->signIn()
            ->post('/threads', $thread->toArray());

        $this
            ->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
