            <div class="card bg-dark border-secondary text-white mb-4">
                {{-- <div class="card-header">{{ $reply->title }}</div> --}}

                <div class="card-body">
                    <h5 class="card-title mb-2 text-white">{{ $reply->author->name }} said...</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $reply->created_at->diffForHumans() }}</h6>

                    {{ $reply->body }}
                </div>
            </div>
