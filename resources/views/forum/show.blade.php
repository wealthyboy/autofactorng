@extends('layouts.forum')

@section('content')
<div class="bg-light">
    <div class="">
        <div id="post-skelenton" class="container my-4">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex mb-2">
                                <div class="skeleton-avatar me-3"></div>
                                <div class="flex-grow-1">
                                    <div class="skeleton-line w-25 mb-1"></div>
                                    <div class="skeleton-line w-50"></div>
                                </div>
                            </div>
                            <div class="skeleton-line w-100 mb-2"></div>
                            <div class="skeleton-line w-100 mb-2"></div>
                            <div class="skeleton-line w-75"></div>
                        </div>
                </div>
                @endfor
            </div>
        </div>

    </div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <div>
                <h2 class="card-title mb-1 fw-bold">{{ $topic['title'] }}</h2>
                <p class="text-muted mb-0">
                    <i class="bi bi-folder2-open me-1"></i>{{ $topic['category']->name }}
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <show-forum :topicShow='@json($topic)' />
            </div>
        </div>
    </div>
</div>




@endsection

@push('scripts')

@endpush