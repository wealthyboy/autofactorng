@extends('layouts.app')

@section('content')
@include('_partials.top_banner')



<div class="container-fluid">
    <!-- <div class="p-3 mb-2 bg-danger text-white text-center">Just in Autocover now available</div> -->
    <div class="row g-2">
        @include('_partials.slider')

    </div>
</div>

<div class="container-fluid">


    @include('_partials.recently_viewed_products',['name' => ' RECENTLY VIEWED & RELATED'])

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

$(".menu-nav-btn").on("click", function() {
let open = $(".menu-open");
let close = $(".menu-close");

if (open.hasClass("d-none")) {
open.removeClass("d-none");
close.addClass("d-none");
$(".overlay").addClass("d-none");
$('html, body').css({
overflow: 'auto',
height: 'auto'
});

} else {
open.addClass("d-none");
close.removeClass("d-none");
$(".overlay").removeClass("d-none");
$('html, body').css({
overflow: 'hidden',
height: '100%'
});

}

});

$(".overlay").on("click", function() {
let self = $(this);
self.addClass("d-none");
let open = $(".menu-open");
open.removeClass("d-none");
$(".menu-close").addClass("d-none");
});

@stop