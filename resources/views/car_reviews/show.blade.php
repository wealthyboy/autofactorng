@extends('layouts.forum')

@section('content')

<section class="hero">
    <div class="container">
        <h1 class="fw-bold display-5">Car Talk’s Golden Wrench Awards</h1>
        <p class="lead mt-3">
            Car Talk is the only place where mechanics and owners have a direct say in our evaluation of cars, parts, and services.
        </p>
        <div class="position-relative mt-5">
            <img src="cars-lineup.png" alt="Cars" class="cars img-fluid">
            <img src="golden-wrench-logo.png" alt="Golden Wrench Badge" class="logo-badge">
        </div>
    </div>
</section>
<div class="container text-center">
    <h2 class="mb-4">{{ $review->title }}</h2>

    <img src="{{ $review->image }}" class="img-fluid mb-4" alt="{{ $review->title }}">

    <div class="mx-auto" style="max-width: 700px;">
        <p class="lead"> {!! html_entity_decode($review->content) !!}
        </p>
    </div>
</div>
@endsection