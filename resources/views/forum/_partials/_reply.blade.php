<div class="card mb-3 ms-{{ isset($depth) ? min($depth * 3, 5) : 0 }}">
    <div class="card-body">
        <div class="d-flex align-items-center mb-2">
            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
            </div>
            <strong class="me-2">{{ optional($reply->user)->name }}</strong>
            <small class="text-muted">{{ optional($reply->created_at)->diffForHumans() }}</small>
        </div>
        <p class="mb-2">{{ $reply->content }}</p>

        <div class="d-flex justify-content-end">
            <a href="" class="text-decoration-none small"><i class="bi bi-reply me-1"></i>Reply</a>
        </div>

        {{-- NESTED REPLIES --}}
        @if( null !== $reply->children)
        @foreach($reply->children as $child)
        @include('forum.._partials._reply', ['reply' => $child, 'depth' => isset($depth) ? $depth + 1 : 1])
        @endforeach
        @endif
    </div>
</div>