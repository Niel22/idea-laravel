<div>
    @auth
        <form action="{{ route('ideas.comments.store', ['idea' => $idea]) }}" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <textarea name="comment" class="fs-6 form-control" rows="1">{{ old('comment') }}</textarea>
            </div>
            @error('comment')
                <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
            @enderror
            <div>
                <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
            </div>
        </form>
    @endauth
    <hr>
    @forelse ($idea->comments as $comment)
        <div class="d-flex align-items-start">
            <img style="width:35px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageUrl() }}"
                alt="{{ $comment->user->name }}">
            <div class="w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="">{{ $comment->user->name }}
                    </h6>
                    <small class="fs-6 fw-light text-muted"> {{ $comment->created_at->diffForHumans() === '0 seconds ago' ? 'Just now' : $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="fs-6 mt-3 fw-light">
                    {{ $comment->comment }}
                </p>
            </div>
        </div>
    @empty
        <p class="text-center my-4"> No Comments for this post </p>
    @endforelse
</div>
