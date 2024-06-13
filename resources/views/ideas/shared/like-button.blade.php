<div>
    @auth
        @if (Auth::user()->liked($idea))
            <form action="{{ route('ideas.unlike', ['idea' => $idea]) }}" method="post">
                @csrf
                @method('post')
                <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $idea->likes_count }} </button>
            </form>
        @else<form action="{{ route('ideas.like', ['idea' => $idea]) }}" method="post">
                @csrf
                @method('post')
                <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                    </span> {{ $idea->likes_count }} </button>
            </form>
        @endif
    @endauth

    @guest
        <p class="fw-light nav-link fs-6"> <span class="{{ $idea->likes()->count() > 0 ? 'fas' : 'far' }} fa-heart me-1">
            </span> {{ $idea->likes()->count() }} </p>
    @endguest
</div>
