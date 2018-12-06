@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-primary border-dark text-white mb-5">
                <div class="card-header mt-2">
                    <h4>{{ $thread->title }}</h4>
                </div>

                <div class="card-body">
                    <h5 class="card-title mb-2 text-white">{{ $thread->author->name }} said...</h5>
                    <h6 class="card-subtitle mb-2 text-dark">{{ $thread->created_at->diffForHumans() }}</h6>

                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">

        @foreach($thread->replies as $reply)

            <div class="card bg-dark border-secondary text-white mb-4">
                {{-- <div class="card-header">{{ $reply->title }}</div> --}}

                <div class="card-body">
                    <h5 class="card-title mb-2 text-white">{{ $reply->author->name }} said...</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $reply->created_at->diffForHumans() }}</h6>

                    {{ $reply->body }}
                </div>
            </div>

        @endforeach

        </div>
    </div>
</div>
@endsection
