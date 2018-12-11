<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Reply;
use App\Thread;
use App\Activity;

class ActivityTest extends TestCase
{
    public function test_that_it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create(Thread::class);
        $activity = Activity::first();

        $this->assertActivityExistsFor($thread, 'created');
    }

    public function test_that_it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->assertActivityExistsFor($reply, 'created');
    }

    public function assertActivityExistsFor($model, $action)
    {
        $activity = Activity::first();

        $this
            ->assertDatabaseHas('activities', [
                'action' => $action,
                'user_id' => auth()->id(),
                'subject_id' => $model->id,
                'subject_type' => get_class($model)
            ])
            ->assertEquals($activity->subject->id, $model->id);
    }
}
