<?php

namespace App\Http\Controllers;

use App\User;
use App\Thread;
use App\Reply;
use App\Category;
use App\Filters\ThreadFilter;
use Illuminate\Http\Request;


class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Show threads (optionally filtered).
     */
    public function index(Category $category, ThreadFilter $filter)
    {
        $threads = $this->getThreads($category, $filter);

        return view('threads.index', [
            'threads' => $threads,
            'deleted' => session()->has('deleted')
        ]);
    }

    /**
     * Show the form for creating a new thread.
     */
    public function create()
    {
        return view('threads.create');
    }


    /**
     * Store a newly created thread.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $thread = Thread::create([
            'author_id' => auth()->id(),
            'category_id' => request('category_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect($thread->path());
    }

    /**
     * Display a specific thread.
     */
    public function show($category, Thread $thread)
    {
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(10)
        ]);
    }

    /**
     * Show the form for editing a thread.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update an already stored thread.
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);
    }

    /**
     * Remove an already stored thread.
     */
    public function destroy($category, Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        // NOTE: We can't do $thread->replies()->delete() because replies() uses with/withCount.
        $replies = Reply::where('parent_id', $thread->id)->get();
        foreach ($replies as $reply) {
            $reply->favourites()->delete();
            $reply->delete();
        }
        $thread->favourites()->delete();
        $thread->delete();

        if ($request->wantsJson()) {
            return response(['deleted' => true], 204);
        } else {
            session()->flash('deleted', true);

            return redirect('/threads');
        }
    }

    /**
     * Return all threads (optionally filtered).
     */
    public function getThreads($category, $filter)
    {
        $threads = Thread::filter($filter)->latest();

        if ($category->exists) {
            $threads = $threads->where('category_id', $category->id);
        }

        return $threads->get();
    }
}
