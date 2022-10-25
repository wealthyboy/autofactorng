<?php if(null !== $products): ?>

<section class="new-products-section">
   <div class="container">
      <h2 class="">New Arrivals</h2>
      <div class="underline mb-5"></div>


      <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2" data-owl-options="{
						'dots': false,
						'nav': true,
						'responsive': {
							'992': {
								'items': 4
							},
							'1200': {
								'items': 5
							}
						}
					}">

         <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
            <figure>
               <a href="product.html">
                  <img src="<?php echo e($product->image->image); ?>" width="220" height="220" alt="product">
                  <img src="<?php echo e($product->image->image); ?>" width="220" height="220" alt="product">
               </a>
               <!-- <div class="label-group">
                  <div class="product-label label-hot">HOT</div>
               </div> -->
            </figure>
            <div class="product-details  align-items-start">
               <!-- <div class="category-list">
                  <a href="category.html" class="product-category">Category</a>
               </div> -->
               <h3 class="product-title">
                  <a href="/"><?php echo e($product->name); ?></a>
               </h3>
               <div class="ratings-container text-left">
                  <div class="product-ratings">
                     <span class="ratings" style="width:80%"></span>
                     <!-- End .ratings -->
                     <span class="tooltiptext tooltip-top"></span>
                  </div>
                  <!-- End .product-ratings -->
               </div>
               <!-- End .product-container -->
               <div class="price-box">
                  <del class="old-price">$59.00</del>
                  <span class="product-price">$49.00</span>
               </div>
               <!-- End .price-box -->
               <!-- <div class="product-action">
                  <a href="demo4." class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
               </div> -->
            </div>
            <!-- End .product-details -->
         </div>

         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
      <!-- End .featured-proucts -->

      <div class="banner banner-big-sale appear-animate" data-animation-delay="200" data-animation-name="fadeInUpShorter" style="background: #2A95CB center/cover url('assets/images/demoes/demo4/banners/banner-4.jpg');">
         <div class="banner-content row align-items-center mx-0">
            <div class="col-md-9 col-sm-8">
               <h2 class="text-white text-uppercase text-center text-sm-left ls-n-20 mb-md-0 px-4">
                  <b class="d-inline-block mr-3 mb-1 mb-md-0">Big Sale</b> Get deals up to 70% off
                  <small class="text-transform-none align-middle">Online Purchases Only</small>
               </h2>
            </div>
            <div class="col-md-3 col-sm-4 text-center text-sm-right">
               <a class="btn btn-light btn-white btn-lg" href="/deals">View Sale</a>
            </div>
         </div>
      </div>


   </div>
</section>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/recently_viewed_products.blade.php ENDPATH**/ ?>