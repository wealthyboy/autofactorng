@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row">
      <nav aria-label="breadcrumb" class="breadcrumb-nav bg-white">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="demo4.html">
               <i class="icon-home"></i>
               </a>
            </li>
            <li class="breadcrumb-item">
               <a href="category-list.html#">Men</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Accessories</li>
         </ol>
      </nav>
   </div>
   <div class="row g-0">
      
      <div class="col-lg-6 product-single-gallery d-lg-flex order-0 order-lg-0">
        <div class="product-slider-container mb-auto">
            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                <div class="product-item">
                    <img class="product-single-image" src="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" data-zoom-image="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png"  alt="product" />
                </div>
                <div class="product-item">
                    <img class="product-single-image" src="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" data-zoom-image="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png"  alt="product" />
                </div>
                <div class="product-item">
                    <img class="product-single-image" src="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" data-zoom-image="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png"  alt="product" />
                </div>
                <div class="product-item">
                    <img class="product-single-image" src="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" data-zoom-image="https://autofactor.ng/images/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png"  alt="product" />
                </div>
            </div>
            <!-- End .product-single-carousel -->
            <!-- <span class="prod-full-screen">
                <i class="icon-plus"></i>
            </span> -->
        </div>

        <div class="prod-thumbnail thumb-vertical owl-dots d-lg-block order-lg-first" id='carousel-custom-dots'>
            <div class="owl-dot">
                <img src="https://autofactor.ng/images/tn/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" width="110" height="110" alt="product-thumbnail" />
            </div>
            <div class="owl-dot">
                <img src="https://autofactor.ng/images/tn/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" width="110" height="110" alt="product-thumbnail" />
            </div>
            <div class="owl-dot">
                <img src="https://autofactor.ng/images/tn/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" width="110" height="110" alt="product-thumbnail" />
            </div>
            <div class="owl-dot">
                <img src="https://autofactor.ng/images/tn/products/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" width="110" height="110" alt="product-thumbnail" />
            </div>
        </div>
    </div>
      <div class="col-md-6">
        <div class="product-single-details mb-1">
            <h1 class="product-title">Men Black Sports Shoes</h1>
            <div class="ratings-container">
               <div class="product-ratings">
                  <span class="ratings" style="width:60%"></span>
                  <!-- End .ratings -->
                  <span class="tooltiptext tooltip-top"></span>
               </div>
               <!-- End .product-ratings -->
               <a href="product-full-width.html#" class="rating-link">( 6 Reviews )</a>
            </div>
            <!-- End .ratings-container -->
            <hr class="short-divider">
            <div class="d-flex justify-content-between">
                <div class="price-box">
                    <span class="old-price">$1,999.00</span>
                    <span class="new-price">$1,699.00</span>
                </div>
                <div class="input-group">
                    <span class="input-group-btn input-group-prepend">
                        <button class="btn btn-outline btn-down-icon" type="button"></button>
                    </span>
                    <input class="horizontal-quantity form-control" type="text">
                    <span class="input-group-btn input-group-append">
                        <button class="btn btn-outline btn-up-icon " type="button"></button>
                    </span>
                </div>

            </div>
           
            <!-- End .price-box -->
            
           
         </div>
        <div class="add-to-cart">
            <button type="button" class="btn bg-gradient-dark mb-0 ms-lg-3 ms-sm-2 mb-sm-0 mb-2 me-auto w-100 d-block">Add To Cart</button>
        </div>
      </div>
   </div>
</div>
<hr />
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div  class="header">
                <h2>
                   PRODUCT SPECIFICATIONS
                </h2>
                <table class="table table-striped">
                    <tr>
                        <td class="">Design- Inserted</td>
                    </tr>
                    <tr>
                        <td class="">Qty- 1 Piece</td>
                    </tr>
                    <tr>
                        <td class="">.Product Fit- Direct fit</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div  class="header">
                <h2>
                   PRODUCT DESCRIPTION
                </h2>
                Replace your ineffective MAF Sensor with Original Equipment Standard (OE) genuine MAF Sensor. To give your vehicle that optimum standard characteristics you can trust.
            </div>
        </div>

        @include('_partials.recently_viewed_products',['name' => 'Related Products'])  

    </div>
</div>

<hr />

<div class="container-fluid">
    <div class="row">
        <div class="title">
            <h2 class="">Reviews</h2>
            <div class="underline mb-5"></div>
        </div>
    </div>
</div>


@endsection
@section('inline-scripts')
@stop