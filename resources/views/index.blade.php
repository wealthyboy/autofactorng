@extends('layouts.app')

@section('content')
@include('_partials.top_banner')

<div class="container-fluid">
    <!-- <div class="p-3 mb-2 bg-danger text-white text-center">Just in Autocover now available</div> -->
    <div class="row g-2">
        @include('_partials.slider')
        <div class="col-md-3">
            <img src="http://auto.test/images/banners/d3fdRL3jfoTLQL8rAXX3wKAxOZXySW0fEagwprZy.jpg" alt="">
        </div>

    </div>
</div>

<div class="container-fluid">
    @include('_partials.recently_viewed_products',['name' => ' RECENTLY VIEWED & RELATED'])

</div>

<div class="text-center cta-simple cta-border light my-5">
    <div class="title w-100 p-2">
        <h3>SET YOUR VEHICLE</h3>
        <p>Get an exact fit for your vehicle.</p>
    </div>
    <div class="d-flex justify-content-between  align-content-center pt-2">
        <make-model-year-search :filter="true"></make-model-year-search>
    </div>
</div>


@include('_partials.auto_cover')

@include('_partials.categories')

@include('_partials.brands')

<div class="row">
    <div class="col-12 text-center p-3">
        <a href="/brands" type="button" class="btn btn-outline-info">More Brands</a>
    </div>
</div>
</div>

@endsection

@section('inline-scripts')



@stop