<div class="card mb-4">
    <div class="card-body">
        <form method="POST" action="/{{ $thread->pathWithoutCategory(true) }}">
             @csrf

            <div class="form-group">
                <label for="body">Type a reply...</label>
                <textarea class="form-control" id="body" name="body" rows="3" placeholder="Your reply here..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
