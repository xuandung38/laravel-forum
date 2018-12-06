<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use DatabaseMigrations;

    protected function signIn($user = null)
    {
        $user = $user ? : create(User::class);

        $this->actingAs($user);

        return $this;
    }
}
