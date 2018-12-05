<?php

use Illuminate\Database\Seeder;

class ThreadsRepliesAndAuthors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory('App\Thread', 20)->create();

        $threads->each(function ($thread) {
            factory('App\Reply', 10)->create(['parent_id' => $thread->id]);
        });
    }
}
