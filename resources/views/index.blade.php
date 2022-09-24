@extends('layouts.app')
@section('content')
@include('_partials.top_banner')

<div class="container-fluid">
    <!-- <div class="p-3 mb-2 bg-danger text-white text-center">Just in Autocover now available</div> -->
    <div class="row g-2">
        
      @include('_partials.slider')
        <div class="col-md-3  ">
          @include('_partials.search')
        </div>
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
(function ($) {
    "use strict";

    jQuery(function () {
        $(".cities-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            center: true,
            navText: [
                '<div class="nav-btn prev-slide"><svg width="31" height="50" viewBox="0 0 21 40" xmlns="http://www.w3.org/2000/svg"><path d="M19.9 40L1.3 20 19.9 0" stroke="#FFF" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>',
                '<div class="nav-btn next-slide"><svg width="19" height="40" viewBox="0 0 19 40" xmlns="http://www.w3.org/2000/svg"><path d="M.1 0l18.6 20L.1 40" stroke="#FFF" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 7,
                },
            },
        });

        $(".main-slider").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            animateIn: "fadeIn",
            animateOut: "fadeOut",
            navText: [
                '<div class="nav-btn prev-slide"><svg width="31" height="50" viewBox="0 0 21 40" xmlns="http://www.w3.org/2000/svg"><path d="M19.9 40L1.3 20 19.9 0" stroke="#FFF" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>',
                '<div class="nav-btn next-slide"><svg width="19" height="40" viewBox="0 0 19 40" xmlns="http://www.w3.org/2000/svg"><path d="M.1 0l18.6 20L.1 40" stroke="#FFF" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 1,
                },
            },
        });
    });
})(jQuery);
@stop


