@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form method="POST" action="/threads">
                        @csrf

                        <div class="form-group">
                            <label for="title">Type a reply...</label>
                            <input class="form-control" id="title" name="title" placeholder="Thread Title" />
                        </div>

                        <div class="form-group">
                            <label for="body">Type a reply...</label>
                            <textarea class="form-control" id="body" name="body" rows="3" placeholder="Thread Content"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
