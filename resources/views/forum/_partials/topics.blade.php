@foreach ($topics as $topic)



<div class="d-flex thread-row border-bottom p-3">
    <div class="topic-cell">
        <div class="thread-title pinned">
            <i class="bi bi-pin-angle-fill text-warning me-1"></i>
            <h5 class="mb-1">
                <a href="{{ route('forum.show', $topic->id) }}" class="text-dark fw-semibold">
                    {{ $topic->title }}
                </a>
            </h5>
        </div>
        <div class="thread-meta"><i class="bi bi-folder2-open me-1"></i> {{ $topic->category->name }}</div>
        <div class="text-muted small mt-1"> {{ \Illuminate\Support\Str::limit($topic->content, 120) }}</div>
    </div>

    <div class="d-flex thread-row  justify-content-center meta-cell ">
        @foreach ($topic->latestUsers as $user)
        <div class="avatar bg-primary text-white rounded-circle d-flex mt-3 align-items-center justify-content-center me-1" style="width: 32px; height: 32px;">
            A
        </div>
        @endforeach
    </div>
    <div class="meta-cell align-items-center justify-content-center d-flex ">{{ optional($topic->replies)->count() }}</div>
    <div class="meta-cell justify-content-center align-items-center d-flex ">{{ $topic->views_count }}</div>
    <div class="meta-cell justify-content-center align-items-center d-flex ">{{ $topic->updated_at->diffForHumans() }}</div>
</div>
@endforeach