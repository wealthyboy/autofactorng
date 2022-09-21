@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- <div class="p-3 mb-2 bg-danger text-white text-center">Just in Autocover now available</div> -->
    <div class="row g-0">
      @include('_partials.slider')
        <div class="col-md-3 bg-light ">
           <form action=""></form>
        </div>
    </div>
</div>

   <div class="container-fluid">

   <div class="row mt-5">
      <div class="col-md-12">
         <div class="title">
            <h2 class="">RECENTLY VIEWED & RELATED</h2>
            <div class="underline mb-5"></div>
         </div>
         <div class="cities-carousel owl-carousel svg-arrows ">
            <div class="slider-related-products">
               <div class="product-default inner-quickview inner-icon">
                  <figure>
                     <a href="/plans?type=auto_cover">
                     <img   src="https://magnetictheme.net/chakta/assets/images/shop/products-14.jpg">
                     </a>
                  </figure>
                  <div class="product-details">
                     <div class="product-title">
                        <a href="#">17 Inch Rim</a>
                     </div>
                     <div class="price-box">
                        <span title="" class="product-price  bold">₦890,000</span>
                     </div>
                     <!-- End .price-box -->
                  </div>
                  <!-- End .product-details -->
               </div>
            </div>
            <div class="slider-related-products">
               <div class="product-default inner-quickview inner-icon">
                  <figure>
                     <a href="">
                     <img  src="https://magnetictheme.net/chakta/assets/images/shop/products-15.jpg">
                     </a>
                  </figure>
                  <div class="product-details">
                     <div class="product-title">
                        <a href="#">Motor Oil</a>
                     </div>
                     <div class="price-box">
                        <span title="" class="product-price  bold">₦890,000</span>
                     </div>
                     <!-- End .price-box -->
                  </div>
                  <!-- End .product-details -->
               </div>
            </div>
            <div class="slider-related-products">
               <div class="product-default inner-quickview inner-icon">
                  <figure>
                     <a href="">
                     <img  src="https://templates.hibootstrap.com/maxon/default/assets/img/products/products-1.jpg">
                     </a>
                  </figure>
                  <div class="product-details">
                     <div class="product-title">
                        <a href="#">Walnut Wall</a>
                     </div>
                     <div class="price-box">
                        <span title="" class="product-price  bold">₦890,000</span>
                     </div>
                     <!-- End .price-box -->
                  </div>
                  <!-- End .product-details -->
               </div>
            </div>
            <div class="slider-related-products">
               <div class="product-default inner-quickview inner-icon">
                  <figure>
                     <a href="">
                     <img  src="https://templates.hibootstrap.com/maxon/default/assets/img/products/products-3.jpg">
                     </a>
                  </figure>
                  <div class="product-details">
                     <div class="product-title">
                        <a href="#">17 Inch Rim</a>
                     </div>
                     <div class="price-box">
                        <span title="" class="product-price  bold">₦890,000</span>
                     </div>
                     <!-- End .price-box -->
                  </div>
                  <!-- End .product-details -->
               </div>
            </div>
            <div class="slider-related-products">
               <div class="product-default inner-quickview inner-icon">
                  <figure>
                     <a href="">
                     <img  src="https://templates.hibootstrap.com/maxon/default/assets/img/products/products-6.jpg">
                     </a>
                  </figure>
                  <div class="product-details">
                     <div class="product-title">
                        <a href="#">Tires Collection</a>
                     </div>
                     <div class="price-box">
                        <span title="" class="product-price  bold">₦890,000</span>
                     </div>
                     <!-- End .price-box -->
                  </div>
                  <!-- End .product-details -->
               </div>
            </div>
            <div class="slider-related-products">
               <div class="product-default inner-quickview inner-icon">
                  <figure>
                     <a href="/checkout">
                     <img  src="https://templates.hibootstrap.com/maxon/default/assets/img/products/products-5.jpg">
                     </a>
                  </figure>
                  <div class="product-details">
                     <div class="product-title">
                        <a href="#">Car Engine</a>
                     </div>
                     <div class="price-box">
                        <span title="" class="product-price  bold">₦890,000</span>
                     </div>
                     <!-- End .price-box -->
                  </div>
                  <!-- End .product-details -->
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-5">
      <div class="col-md-6 my-1">
         <div style="height: 250px;" class="bg-dark h-35 d-flex justify-content-center align-items-center text-white">
            <a  class="text-white bold fs-1" href="/plans?type=auto_cover">AUTO COVER</a>
         </div>
      </div>
      <div class="col-md-6 my-1">
         <div style="height: 250px;" class="bg-dark h-35 d-flex justify-content-center align-items-center text-white">
            <a  class="text-white bold fs-1" href="/buy-now-pay-later?type=auto_cover">BUY NOW PAY LATER</a>
         </div>
      </div>

    
   </div>

   @if($featured_categories->count())
   <div class="row mt-5">
      <div class="">
         <h2 class="">FEATURED CATEGORIES</h2>
         <div class="underline mb-5"></div>
      </div>
      @foreach($featured_categories as $key => $category)
      <div class="col-md-3 border  col-6 text-center">
         <div class="category-content d-flex justify-content-center align-items-center">
            <a href="{{ $category->link() }}" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
               <div class="category-image"><img src="{{ $category->image }}" alt="" srcset="" class="img-fluid"></div>
               <div class="mt-4  bold">{{ $category->name }}</div>
            </a>
         </div>
      </div>
      @endforeach
   </div>
   @endif
   <div class="row mt-5 no-gutters">
      <div>
         <h2 class="">BRANDS WE TRUST</h2>
         <div class="underline mb-5"></div>
      </div>


      @foreach($brands as $key => $brand)
      <div class="col-md-3 border  col-6 text-center">
         <div class="category-content d-flex justify-content-center align-items-center">
            <a href="{{ $brand->link() }}" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
               <div class="category-image"><img src="{{ $brand->image }}" alt="" srcset="" class="img-fluid"></div>
            </a>
         </div>
      </div>
      @endforeach

      
    
   </div>
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


