<?php $__env->startSection('content'); ?>
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
                    <img class="product-single-image" src="https://autofactor.ng/images/products/lm9BpEBOsRulb86ATdlrDOi5JzkInmOp5RTYBMZ8.png" data-zoom-image="https://autofactor.ng/images/products/lm9BpEBOsRulb86ATdlrDOi5JzkInmOp5RTYBMZ8.png"  alt="product" />
                </div>
                
            </div>
            <!-- End .product-single-carousel -->
            <!-- <span class="prod-full-screen">
                <i class="icon-plus"></i>
            </span> -->
        </div>



        <div class="prod-thumbnail thumb-vertical owl-dots d-lg-block order-lg-first" id='carousel-custom-dots'>
            <div class="owl-dot">
                <img src="https://autofactor.ng/images/products/lm9BpEBOsRulb86ATdlrDOi5JzkInmOp5RTYBMZ8.png" width="110" height="110" alt="product-thumbnail" />
            </div>
            
        </div>
    </div>
      <div class="col-md-6">
        <div class="product-single-details mb-1">
            <h1 class="product-title">Toyota Front ABS Wheel Speed Sensor (2ABS0476) LH&RH (Pair)</h1>
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

        <?php echo $__env->make('_partials.recently_viewed_products',['name' => 'RELATED PRODUCTS'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  

    </div>
</div>

<hr />

<div class="container-fluid">
    <div class="row">
        <div class="title">
            <h2 class="">REVIEWS</h2>
            <div class="underline mb-5"></div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
(function ($) {
    "use strict";

    jQuery(function () {
        $(".product-single-carousel").owlCarousel({
            nav: 0,
            dotsContainer: "#carousel-custom-dots",
            autoplay: !1,
           
        });

        
    });
})(jQuery);

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/products/show.blade.php ENDPATH**/ ?>