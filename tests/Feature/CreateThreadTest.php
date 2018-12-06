<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\User;
use App\Thread;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use App\Category;

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

        $response = $this
            ->signIn()
            ->post('/threads', $thread->toArray());

        $this
            ->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_that_a_thread_requires_a_title()
    {
        $this
            ->createThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    public function test_that_a_thread_requires_a_body()
    {
        $this
            ->createThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_that_a_thread_requires_a_valid_category_id()
    {
        factory(Category::class, 2)->create();

        $this
            ->createThread(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this
            ->createThread(['category_id' => 100])
            ->assertSessionHasErrors('category_id');
    }

    private function createThread($attributes = [])
    {
        $this->signIn();

        $thread = make(Thread::class, $attributes);

        return $this->post('/threads', $thread->toArray());
    }
}
