<article>
    {{-- <div style="display: flex;">
        <h4 style="flex: 1;"><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
        <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
    </div> --}}

    <div class="body">
        {{ $activity->created_at->diffForHumans() }}, {{ $activity->subject->author->name }} 
        <a href="{{ $activity->subject->path() }}">{{ $activity->action }} a {{ $activity->subject_type }}</a> 
        in <a href="{{ $activity->subject->parent->path() }}">{{ $activity->subject->parent->title }}</a>
    </div>
</article>
