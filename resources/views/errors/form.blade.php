@if (count($errors))
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">One or more errors occured</h4>

        <ul class="mb-0 pl-4">
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
        </ul>
    </div>
@endif
