<?php if(null !== $products): ?>
<h4 class="text-uppercase  mb-0 mb-3 display-4">
   FEATURED
   <strong>
      PRODUCTS
   </strong>
</h4>
<div class="underline mb-5 ms-1"></div>

<div class="related-products-slider owl-carousel owl-theme show-nav-hover nav-outer nav-image-center ">

   <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div itemscope itemtype="https://schema.org/Product" class="product-default  product-default-sm d-flex flex-column justify-content-center align-items-center px-2">
      <figure class="image-category mt-3">
         <a title="Click to buy car parts, <?php echo e($product->name); ?>" href="<?php echo e($product->link); ?>">
            <img itemprop="image" class="owl-lazy" title="Click to buy car parts,  <?php echo e($product->name); ?>" data-src="<?php echo e($product->image_m); ?>" alt="<?php echo e($product->name); ?>">
         </a>
      </figure>
      <a href="#">

         <div class="product-details-content">
            <div class="d-flex flex-column text-start">
               <a href="<?php echo e($product->link); ?>">
                  <div class="pr">
                     <div itemprop="name" title="Click to buy car parts,  <?php echo e($product->name); ?>" class="text-black"><?php echo e($product->name); ?></div>
                  </div>
               </a>

               <div class="ratings-container">
                  <?php echo $__env->make('_partials.ratings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>


               <div itemprop="offers" itemscope itemtype="https://schema.org/AggregateOffer" class="price-box mt-2">
                  <?php if($product->discounted_price): ?>
                  <div>
                     <span itemprop="Price" class="old-price bold"><?php echo e($product->currency); ?><?php echo e($product->formatted_sale_price); ?></span>
                     <span itemprop="Price" class="product-price bold"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
                  </div>
                  <?php else: ?>
                  <div>
                     <span itemprop="Price" class="product-price bold"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
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