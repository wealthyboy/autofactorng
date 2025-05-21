@extends('layouts.forum')

@section('content')
<section class="hero">
    <div class="container">
        <h1 class="fw-bold display-6">Car Talk’s Golden Wrench Awards</h1>
        <p class="lead mt-3">
            Car Talk is the only place where mechanics and owners have a direct say in our evaluation of cars, parts, and services.
        </p>
        <div class="position-relative mt-5">
            <img src="/images/utils/golden-wrench-feature.jpg" alt="Golden Wrench Badge" class="img-fluid">
        </div>
    </div>
</section>


<div class="container">
    <h2 class="mb-4">Latest Car Reviews</h2>

    @if($reviews->isEmpty())
    <div class="alert alert-info">No reviews available.</div>
    @else
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-5 g-4">
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
    @endif

</div>
@endsection