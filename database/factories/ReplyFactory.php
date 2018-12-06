<?php

use Faker\Generator as Faker;
use App\User;
use App\Reply;
use App\Thread;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'author_id' => function () {
            return factory(User::class)->create()->id;
        },
        'parent_id' => function () {
            return factory(Thread::class)->create()->id;
        },
        'body' => $faker->paragraph
    ];
});
