@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($deleted)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                The thread was deleted successfully!
            </div>
            @endif

            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @forelse($threads as $thread)
                        <article>
                            <div style="display: flex;">
                                <h4 style="flex: 1;"><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                                <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
                            </div>

                            <div class="body">
                                {{ $thread->body }}
                            </div>
                        </article>

                        <hr />
                    @empty
                        <p class="mb-0">There are no threads to display, why don't you <a href="/threads/create">be the first</a>?</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
