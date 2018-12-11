<?php

namespace App;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        // NOTE: Because in our tests there sometimes won't be an authenticated user.
        if (auth()->guest()) {
            return;
        }

        foreach (static::$activities as $eventName) {
            static::$eventName(function ($thread) use ($eventName) {
                $thread->record($eventName);
            });
        }
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function record($eventName)
    {
        $this->activities()->create([
            'action' => $eventName,
            'user_id' => auth()->id(),
            'subject_id' => $this->id,
            'subject_type' => get_class($this)
        ]);
    }
}
