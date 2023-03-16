@extends('layouts.app')

@section('content')
@include('_partials.top_banner')

<div class="class">
    <div class="container-fluid mt-3">
        <div class="row g-2">
            @include('_partials.slider')

        </div>
    </div>
</div>


<div class="container-fluid mt-4">
    @include('_partials.recently_viewed_products',['name' => 'RECENTLY VIEWED & RELATED'])
</div>

<div class="underline w-100"></div>
<div class="text-center cta-simple cta-border  mb-5 bg-gray  ">
    <add-vehicle-search></add-vehicle-search>
</div>


@include('_partials.auto_cover')
<div class="container-fluid mt-5">
    @include('_partials.categories')
</div>


<div class="container-fluid">
    @include('_partials.brands')
</div>

<div class="row">
    <div class="col-12 text-center p-3">
        <a href="/brands" type="button" class="btn btn-outline-info">More Brands</a>
    </div>
</div>
</div>


@endsection

@section('inline-scripts')



@stop