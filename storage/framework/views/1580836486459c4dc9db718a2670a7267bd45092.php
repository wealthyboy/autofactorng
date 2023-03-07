<?php if(null !== $products): ?>
<h4 class="text-uppercase  mb-0 mb-3 display-4">
   FEATURED
   <strong>
      PRODUCTS
   </strong>
</h4>
<div class="underline mb-5 ms-1"></div>

<div class="owl-carousel owl-theme show-nav-hover nav-outer nav-image-center " data-owl-options="{
					'dots': false,
					'margin': 10,
					'loop': false,
					'nav': true,
					'autoplay': true,

					'responsive': {
						'480': {
							'items': 1
						},
						'768': {
							'items': 2
						},
						'992': {
							'items': 8
						}
					}
				}">

   <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="product-default  product-default-sm d-flex flex-column justify-content-center align-items-center px-2">
      <figure class="image-category mt-3">
         <a href="<?php echo e($product->link); ?>">
            <img src="<?php echo e($product->image_m); ?>" alt="product">
         </a>
      </figure>
      <a href="#">

         <div class="product-details-content">
            <div class="d-flex flex-column text-start">

               <a href="<?php echo e($product->link); ?>">
                  <div class="product-title">
                     <div class="product-title-label fs-5"><?php echo e($product->name); ?></div>
                  </div>
               </a>



               <div class="ratings-container">
                  <?php echo $__env->make('_partials.ratings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <!-- End .product-ratings -->
               </div>


               <div class="price-box mt-4">
                  <?php if($product->discounted_price): ?>
                  <div>
                     <span class="old-price bold"><?php echo e($product->currency); ?><?php echo e($product->formatted_sale_price); ?></span>
                     <span class="product-price bold"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
                  </div>
                  <?php else: ?>
                  <div>
                     <span class="product-price bold"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
                  </div>
                  <?php endif; ?>
               </div>
            </div>

         </div>
      </a>


      <!-- End .product-details -->
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/recently_viewed_products.blade.php ENDPATH**/ ?>