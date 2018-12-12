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
                        Activity
                    </div>

                    <div class="card-body">
                        @foreach ($activities as $activity)
                            @include("profiles.activities.all")
                        @endforeach

                        {{-- {{ $threads->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
