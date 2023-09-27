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
            <div class="col-lg-3 order-1 order-lg-0">
                <div class="product-single-details">
                    <h1 class="product-title mb-1">Men Black Sports Shoes</h1>

                    <div class="product-nav">
                        <div class="product-prev">
                            <a href="#">
                                <span class="product-link"></span>

                                <span class="product-popup">
                                    <span class="box-content">
                                        <img alt="product" width="150" height="150" src="assets/images/products/product-3.jpg" style="padding-top: 0px;">

                                        <span>Circled Ultimate 3D Speaker</span>
                                    </span>
                                </span>
                            </a>
                        </div>

                        <div class="product-next">
                            <a href="#">
                                <span class="product-link"></span>

                                <span class="product-popup">
                                    <span class="box-content">
                                        <img alt="product" width="150" height="150" src="assets/images/products/product-4.jpg" style="padding-top: 0px;">

                                        <span>Blue Backpack for the Young</span>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->

                        <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div>
                    <!-- End .ratings-container -->

                    <hr class="short-divider">

                    <div class="price-box pt-1">
                        <span class="product-price">$119.00</span>
                        <span class="product-price"> – <span>$130.00</span></span>
                    </div>

                    <div class="product-desc">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non.</p>
                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">
                        <!---->
                        <li>
                            SKU: <strong>PT0005</strong>
                        </li>

                        <li>
                            CATEGORIES:
                            <strong><a href="#" class="product-category">CLOTHING</a></strong>,
                            <strong><a href="#" class="product-category">SHOES</a></strong>,
                            <strong><a href="#" class="product-category">T-SHIRTS</a></strong>,
                            <strong><a href="#" class="product-category">WATCHES</a></strong>
                        </li>
                    </ul>

                    <a href="wishlist.html" class="btn-icon-wish add-wishlist justify-content-start pl-0" title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Add to
                            Wishlist</span></a>
                </div>
            </div>

            <div class="col-lg-6 product-single-gallery d-lg-flex order-0 order-lg-0">
                <div class="product-slider-container mb-auto">
                    <div class="label-group">
                        <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">-16%</div>
                    </div>

                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                        <div class="product-item">
                            <img class="product-single-image" src="assets/images/products/zoom/product-1-big.jpg" data-zoom-image="assets/images/products/zoom/product-1-big.jpg" width="468" height="468" alt="product" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image" src="assets/images/products/zoom/product-2-big.jpg" data-zoom-image="assets/images/products/zoom/product-2-big.jpg" width="468" height="468" alt="product" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image" src="assets/images/products/zoom/product-3-big.jpg" data-zoom-image="assets/images/products/zoom/product-3-big.jpg" width="468" height="468" alt="product" />
                        </div>
                        <div class="product-item">
                            <img class="product-single-image" src="assets/images/products/zoom/product-4-big.jpg" data-zoom-image="assets/images/products/zoom/product-4-big.jpg" width="468" height="468" alt="product" />
                        </div>
                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
                </div>

                <div class="prod-thumbnail thumb-vertical owl-dots d-lg-block order-lg-first" id='carousel-custom-dots'>
                    <div class="owl-dot">
                        <img src="assets/images/products/zoom/product-1.jpg" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    <div class="owl-dot">
                        <img src="assets/images/products/zoom/product-2.jpg" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    <div class="owl-dot">
                        <img src="assets/images/products/zoom/product-3.jpg" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    <div class="owl-dot">
                        <img src="assets/images/products/zoom/product-4.jpg" width="110" height="110" alt="product-thumbnail" />
                    </div>
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