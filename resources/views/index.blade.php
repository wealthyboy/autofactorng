@extends('layouts.app')

@section('content')


<div class="container-fluid">
<!-- <div class="p-3 mb-2 bg-danger text-white text-center">Just in Autocover now available</div> -->

    <div class="row g-0">

           <div class="col-md-9">
               <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="https://www.autofactorng.com/images/banner/Body Part.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="https://www.autofactorng.com/images/banner/Engine oil.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="https://www.autofactorng.com/images/banner/Body Part.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
           </div>
           <div class="col-md-3 bg-light">
                <form action="">
                    <div class="select-box">
                        <div class="select-box__current" tabindex="1">
                            <div class="select-box__value">
                                <input class="select-box__input" type="radio" id="0" value="1" name="Ben" checked="checked"/>
                                <p class="select-box__input-text">Make</p>
                            </div>
                            <div class="select-box__value">
                                <input class="select-box__input" type="radio" id="1" value="2" name="Ben"/>
                                <p class="select-box__input-text">Toyota</p>
                            </div>
                            <div class="select-box__value">
                                <input class="select-box__input" type="radio" id="2" value="3" name="Ben"/>
                                <p class="select-box__input-text">BMW</p>
                            </div>
                            
                            <img class="select-box__icon" src="http://cdn.onlinewebfonts.com/svg/img_295694.svg" alt="Arrow Icon" aria-hidden="true"/>
                        </div>
                        <ul class="select-box__list">
                            <li>
                                <label class="select-box__option" for="0" aria-hidden="aria-hidden">Make</label>
                            </li>
                            <li>
                                <label class="select-box__option" for="1" aria-hidden="aria-hidden">Toyota</label>
                            </li>
                            <li>
                                <label class="select-box__option" for="2" aria-hidden="aria-hidden">BMW</label>
                            </li>
                            
                        </ul>
                    </div>

                    
                </form>
           </div>
        
    </div>

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
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
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
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
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
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
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
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
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
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
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
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div>
                </div>

                
            </div>
            
        </div>
    </div>

    <div class="row mt-5">
    
        <div class="col-md-6">
            <div style="height: 250px;" class="bg-dark h-35 d-flex justify-content-center align-items-center text-white">
               <a  class="text-white bold fs-1" href="/plans?type=auto_cover">AUTO COVER</a>
            </div>
        </div>

        <div class="col-md-6">
            <div style="height: 250px;" class="bg-dark h-35 d-flex justify-content-center align-items-center text-white">
               <a  class="text-white bold fs-1" href="/buy-now-pay-later?type=auto_cover">BUY NOW PAY LATER</a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div>
            <h2 class="">FEATURED CATEGORIES</h2>
            <div class="underline mb-5"></div>
        </div>
        @foreach($cats as $key => $cat)
            <div class="col-md-3 border text-center">
                
                <div class="category-content d-flex justify-content-center align-items-center">
                    <a href="#" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
                        <div class="category-image"><img src="{{ $cat }}" alt="" srcset="" class="img-fluid"></div>
                        <div class="mt-4   bold">{{ $key }}</div>
                    </a>
                </div>
                
            </div>

            

        @endforeach
    </div>


    <div class="row mt-5 no-gutters">
        <div>
           <h2 class="">BRANDS WE TRUST</h2>
           <div class="underline mb-5"></div>
        </div>
       
        <div class="col-md-2">
            <a href="http://">
                <img class="img-fluid" src="https://www.autozone.com/cdn/images/B2C/US/media/Landing/BrandLandingPage/fy20-bwt-mobil1-d.jpg" alt="" srcset="">
            </a>
        </div>

        <div class="col-md-2">
            <a href="http://">
                <img  class="img-fluid" src="https://www.autozone.com/cdn/images/B2C/US/media/Landing/BrandLandingPage/fy20-bwt-castrol-d.jpg" alt="" srcset="">
            </a>
        </div>

        <div class="col-md-2">
            <a href="http://">
                <img class="img-fluid" src="https://www.autozone.com/cdn/images/B2C/US/media/Landing/BrandLandingPage/fy21-bwt-type-s-d.jpg" alt="" srcset="">
            </a>
        </div>

        <div class="col-md-2">
            <a href="http://">
                <img class="img-fluid" src="https://www.autozone.com/cdn/images/B2C/US/media/Landing/BrandLandingPage/fy21-bwt-prestoneperformance-d.jpg" alt="" srcset="">
            </a>
        </div>

        <div class="col-md-2">
            <a href="http://">
                <img class="img-fluid" src="https://www.autozone.com/cdn/images/B2C/US/media/Landing/BrandLandingPage/fy21-bwt-Odyssey-d.jpg" alt="" srcset="">
            </a>
        </div>

        <div class="col-md-2">
            <a href="http://">
                <img class="img-fluid" src="https://www.autozone.com/cdn/images/B2C/US/media/Landing/BrandLandingPage/fy20-bwt-continental-d.jpg" alt="" srcset="">
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-12 text-center p-3">
            <button type="button" class="btn btn-outline-info">More Brands</button>
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
