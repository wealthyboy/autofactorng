@extends('layouts.forum')

@section('content')
<div class="container">
    <h2 class="mb-4">Latest Car Reviews</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($reviews as $review)
        <div class="col">
            <div class="card h-100">
                <a href="{{ route('car.reviews.show', $review->id) }}">
                    <img src="{{ $review->m_image }}" class="card-img-top" alt="{{ $review->title }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('car.reviews.show', $review->id) }}" class="text-decoration-none text-dark">
                            {{ $review->title }}
                        </a>
                    </h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($review->teaser, 100) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection