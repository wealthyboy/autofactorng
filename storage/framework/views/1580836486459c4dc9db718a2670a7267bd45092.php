<?php if(null !== $products): ?>


<h4 class="text-uppercase heading-bottom-border mt-4">FEATURED PRODUCTS</h4>
<div class="owl-carousel owl-theme show-nav-hover nav-outer nav-image-center" data-owl-options="{
					'dots': false,
					'margin': 10,
					'loop': true,
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
							'items': 5
						}
					}
				}">

   <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="product-default left-details product-unfold">
      <figure>
         <a href="<?php echo e($product->link); ?>">
            <img src="<?php echo e($product->image_to_show); ?>" alt="product" width="300" height="300">
            <img src="<?php echo e($product->image_to_show); ?>" alt="product" width="300" height="300">
         </a>
      </figure>
      <div class="product-details">

         <h3 class="product-title"> <a href="<?php echo e($product->link); ?>"><?php echo e($product->name); ?></a> </h3>
         <div class="ratings-container">
            <div class="product-ratings">
               <span class="ratings" style="width:0%"></span>
               <!-- End .ratings -->
               <span class="tooltiptext tooltip-top"></span>
            </div>
            <!-- End .product-ratings -->
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
         <!-- End .price-box -->
         <div class="product-action">
            <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
         </div>
      </div>
      <!-- End .product-details -->
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/recently_viewed_products.blade.php ENDPATH**/ ?>