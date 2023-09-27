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

            <div class="col-lg-3 order-2 order-lg-0">
                <div class="product-single-details">
                    <div class="product-filters-container custom-product-filters pt-0 pb-2 mb-0">
                        <div class="product-single-filter">
                            <label>Color:</label>

                            <ul class="config-size-list config-color-list config-filter-list">
                                <li class="">
                                    <a href="javascript:;" class="filter-color border-0" style="background-color: rgb(1, 136, 204);">
                                    </a>
                                </li>

                                <li class="">
                                    <a href="javascript:;" class="filter-color border-0 initial disabled" style="background-color: rgb(221, 181, 119);">
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="product-single-filter">
                            <label>Size:</label>

                            <ul class="config-size-list">
                                <li><a href="javascript:;" class="d-flex align-items-center justify-content-center">XL</a>
                                </li>
                                <li><a href="javascript:;" class="d-flex align-items-center justify-content-center">L</a>
                                </li>
                                <li class=""><a href="javascript:;" class="d-flex align-items-center justify-content-center">M</a>
                                </li>
                            </ul>
                        </div>

                        <div class="product-single-filter">
                            <label></label>
                            <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                        </div>
                        <!---->
                    </div>

                    <div class="product-action pt-3">
                        <div class="price-box product-filtered-price">
                            <del class="old-price"><span>$286.00</span></del>
                            <span class="product-price">$245.00</span>
                        </div>

                        <div class="product-single-qty d-flex align-items-center mb-1 pb-2">
                            <label class="mr-3 mb-0">QTY:</label>

                            <div class="product-single-qty">
                                <input class="horizontal-quantity form-control" type="text">
                            </div>
                            <!-- End .product-single-qty -->
                        </div>

                        <a href="#" title="Add to Cart" class="btn btn-dark add-cart mr-2 disabled">Add to
                            Cart
                        </a>

                        <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a>
                    </div>

                    <div class="product-single-share custom-product-single-share">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mt-0">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                        </div>
                        <!-- End .social-icons -->
                    </div>
                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
        </div>
    </div>
    <!-- End .product-single-container -->
</div>
<!-- End .container -->
@endsection