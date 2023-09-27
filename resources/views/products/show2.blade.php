@extends('layouts.app')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
        </ol>
    </nav>
    <div class="product-single-container product-single-default product-center-vertical">
        <div class="cart-message d-none">
            <strong class="single-cart-notice">“Men Black Sports Shoes”</strong>
            <span>has been added to your cart.</span>
        </div>

        <div class="row">


            <div class="col-lg-6 product-single-gallery d-lg-flex order-0 order-lg-0">
                <div class="product-slider-container mb-auto">


                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">

                        @foreach($product->images as $image)
                        <div class="product-item">
                            <img class="product-single-image" src="{{ $image->image_l }}" width="468" height="468" alt="product" />
                        </div>
                        @endforeach
                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
                </div>

                <div class="prod-thumbnail thumb-vertical owl-dots d-lg-block order-lg-first d-flex" id='carousel-custom-dots'>


                    @foreach($product->images as $image)
                    <div class="owl-dot ">
                        <img src="{{ $image->image_m }}" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    @endforeach
                </div>
            </div>

            <show :product="{{ $product }}" />

        </div>
    </div>
    <!-- End .product-single-container -->
</div>
<!-- End .container -->
@endsection