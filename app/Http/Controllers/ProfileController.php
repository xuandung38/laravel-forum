<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $activities = $user->activities()
            ->latest()
            ->with(['subject', 'subject.author', 'subject.parent'])
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });

        return view('profiles.show', [
            'profileUser' => $user,
            //'threads' => $user->threads()->paginate(1),
            'activities' => $activities
        ]);
    }
}
