<?php if(null !== $products): ?>
<h4 class="text-uppercase  mb-0 mb-3 display-4">
   FEATURED
   <strong>
      PRODUCTS
   </strong>
</h4>
<div class="underline mb-5 ms-1"></div>

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
      <div class="product-details-content">
         <div class="az_kl">
            <div class="az_ll az_cm">
               <div class="az_phb az_rhb" data-testid="part-label"><?php echo e($product->name); ?></div>
            </div>

            <div class="az_ll az_cm">
               <div class="az_kl az_ll az_Hl az_sl az_cm az_thb">
                  <div class="az_z9">
                     <div class="az_n9 az_Chb" data-testid="price-fragment" aria-label="Total price is: 12 dollars and 99 cents. "><span data-testid="cart-price-icon-deal" class="az_-G az_m9">$</span><span class="az_-i az_o9">12</span><span class="az_-i az_p9"><span class="az_y9">.</span>99</span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- End .product-details -->
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/recently_viewed_products.blade.php ENDPATH**/ ?>