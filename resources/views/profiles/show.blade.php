@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="pb-2 h1 mt-4 mb-4 text-white border-bottom">
                   <strong>Profile:</strong> {{ $profileUser->name }}
                </div>

            @foreach ($activities as $date => $groupedActivities)
                <div class="card">
                    <div class="card-header mt-2">
                        <h4>Activity for {{ $date }}</h4>
                    </div>

                    <div class="card-body">
                        <!-- IDEA: Allow subjects to optionally override the view if they need to do anything more advanced than the default? -->
                        @foreach ($groupedActivities as $activity)
                            @include("profiles.activities.default")
                        @endforeach

                        {{-- {{ $threads->links()}} --}}
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
