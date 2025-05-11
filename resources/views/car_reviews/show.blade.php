@extends('layouts.forum')

@section('content')


<section class="breadcrumb no-banner  justify-content-center">
    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  text-center border-bottom">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link mt-3">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Car Reviews
                                <li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">Car Reviews</h1>
                    <p></p>
                </div>
            </div>
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