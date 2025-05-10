@foreach ($topics as $topic)
<div class="bg-white p-3 mb-3 shadow-sm rounded border">
    <div class="d-flex justify-content-between">
        <div>
            <h5 class="mb-1">
                <a href="{{ route('forum.show', $topic->id) }}" class="text-dark fw-semibold">
                    {{ $topic->title }}
                </a>
            </h5>
            <div class="text-muted small">{{ $topic->category->name }}</div>
            <p class="text-secondary small mb-0 mt-2" style="max-width: 600px;">
                {{ \Illuminate\Support\Str::limit($topic->content, 120) }}
            </p>
        </div>

        <div class="text-end d-flex  align-items-end justify-content-between">
            <div class="mb-2 d-flex align-items-center gap-1">
                @foreach ($topic->latestUsers as $user)
                <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" class="rounded-circle" style="width: 32px; height: 32px;" alt="user">
                @endforeach
            </div>

            <div>
                <div><strong>{{ $topic->replies_count }}</strong> replies</div>
                <div><strong>{{ $topic->views }}</strong> views</div>
                <div class="text-muted small">{{ $topic->updated_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>
</div>
@endforeach