<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Reply;
use App\Thread;
use App\Category;

class CategoryTest extends TestCase
{
    public function test_that_a_category_consists_of_threads()
    {
        $category = create(Category::class);
        $thread = create(Thread::class, ['category_id' => $category->id]);

        $this->assertTrue($category->threads->contains($thread));
    }
}
