            <div class="card bg-dark border-secondary text-white mb-3">
                {{-- <div class="card-header">{{ $reply->title }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="/favourites/reply/{{ $reply->id }}">
                        @csrf

                    @if ($reply->isFavourited())
                        {{ method_field('DELETE') }}
                    @endif
                        
                        <button class="btn btn-sm float-right {{ $reply->isFavourited() ? 'btn-secondary' : 'btn-primary' }}">
                            {{ $reply->favourites()->count() >= 1 ? '⭐ ' . $reply->favourites()->count() : '⭐' }}
                        </button>
                    </form>

                    <h5 class="card-title mb-2 text-white">{{ $reply->author->name }} said...</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $reply->created_at->diffForHumans() }}</h6>

                    {{ $reply->body }}
                </div>
            </div>
