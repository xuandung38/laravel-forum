@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="pb-2 h1 mt-4 mb-4 text-white border-bottom">
                   <strong>Profile:</strong> {{ $profileUser->name }}
                </div>

                <div class="card">
                    <div class="card-header mt-2">
                        User's Threads
                    </div>

                    <div class="card-body">
                        @foreach ($threads as $thread)
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
                        @endforeach

                        {{ $threads->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
