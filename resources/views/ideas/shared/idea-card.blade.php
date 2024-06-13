<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageUrl() }}"
                    alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', ['user' => $idea->user->id]) }}">
                            {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            @auth
                @can('update', $idea)
                    @if ($editing ?? false)
                    @else
                        <div>
                            <form action="{{ route('ideas.destroy', ['idea' => $idea]) }}" method="post">
                                @csrf
                                @method('delete')
                                <a class="mx-2" href="{{ route('ideas.edit', ['idea' => $idea]) }}">Edit</a>
                                <a href="{{ route('ideas.show', ['idea' => $idea]) }}">View</a>
                                <button class="ms-1 btn btn-danger btn-sm">X</button>
                            </form>
                        </div>
                    @endif
                @endcan

                @cannot('update', $idea)
                @if ($view ?? false)
                @else
                    <div>
                        <a href="{{ route('ideas.show', ['idea' => $idea]) }}">View</a>
                    </div>
                @endif
                @endcannot
            @else
                @if ($view ?? false)
                @else
                    <div>
                        <a href="{{ route('ideas.show', ['idea' => $idea]) }}">View</a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', ['idea' => $idea]) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="idea" class="form-control" id="idea" rows="3">{{ $idea->idea }}</textarea>
                    @error('idea')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->idea }}
            </p>
        @endif
        @if ($editing ?? false)
        @else
            <div class="d-flex justify-content-between">
                @include('ideas.shared.like-button')
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $idea->created_at->diffForHumans() === '0 seconds ago' ? 'Just now' : $idea->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @include('ideas.shared.comments-box')
        @endif
    </div>

</div>
