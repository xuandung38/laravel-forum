@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('errors.form')

            <div class="card bg-primary border-dark text-white">
                <div class="card-header mt-2">
                    <h4>Create a New Thread</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="/threads">
                        @csrf

                        <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Choose a Category...</option>

                                @foreach (App\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                                </select>
                            </div>

                        <div class="form-group">
                            <label for="title">Title</label>

                            <input class="form-control" id="title" name="title" placeholder="Thread Title" value="{{ old('title') }}" required />
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            
                            <textarea class="form-control" id="body" name="body" rows="3" placeholder="Your reply here." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
