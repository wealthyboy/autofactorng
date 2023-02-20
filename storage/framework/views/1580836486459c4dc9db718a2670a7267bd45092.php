<?php if(null !== $products): ?>
<h4 class="text-uppercase mt-4">FEATURED PRODUCTS</h4>
<div class="owl-carousel owl-theme show-nav-hover nav-outer nav-image-center" data-owl-options="{
					'dots': false,
					'margin': 10,
					'loop': false,
					'nav': true,
					'autoplay': true,
					'responsive': {
						'480': {
							'items': 2
						},
						'768': {
							'items': 3
						},
						'992': {
							'items': 8
						}
					}
				}">

   <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="product-default left-details product-unfold">
      <figure>
         <a href="<?php echo e($product->link); ?>">
            <img src="<?php echo e($product->image_m); ?>" alt="product">
            <img src="<?php echo e($product->image_m); ?>" alt="product">
         </a>
      </figure>
      <div class="product-details">

         <h3 class="product-title"> <a href="<?php echo e($product->link); ?>"><?php echo e($product->name); ?></a> </h3>
         <div class="ratings-container">
            <?php echo $__env->make('_partials.ratings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         </div>
         <!-- End .product-container -->
         <div class="price-box">
            <?php if($product->discounted_price): ?>
            <div>
               <span class="old-price"><?php echo e($product->currency); ?><?php echo e($product->formatted_sale_price); ?></span>
               <span class="product-price"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
            </div>
            <?php else: ?>
            <div>
               <span class="product-price"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
            </div>
            <?php endif; ?>
         </div>

      </div>
      <!-- End .product-details -->
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/recently_viewed_products.blade.php ENDPATH**/ ?>