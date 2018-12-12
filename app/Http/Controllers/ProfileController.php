<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $activities = $user->activities()->with(['subject', 'subject.author'])->get();

        // return $activities;

        return view('profiles.show', [
            'profileUser' => $user,
            //'threads' => $user->threads()->paginate(1),
            'activities' => $activities
        ]);
    }
}
