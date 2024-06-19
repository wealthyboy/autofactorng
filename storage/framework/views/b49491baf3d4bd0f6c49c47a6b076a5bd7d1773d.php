<div itemscope itemtype="https://schema.org/Product" class="col-md-12 col-lg-9">
   <section class="slider-loader loader2">
   </section>
   <section class="p-0  slider-section d-none">

      <div class="owl-carousel owl-theme show-nav-hover slide-animate d-none  d-lg-block d-xl-block" data-owl-options="{
           'dots': true,
           'nav': true,
           'loop': true,
            'autoplay':true,
            'autoplayTimeout':3500,
            'autoplayHoverPause':true,
            'responsiveClass':true,
            'lazyLoad': true

        }">
         <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         <div class="banner banner3 <?php echo e($slider->device); ?>">
            <a href="<?php echo e($slider->link); ?>" class="d-block">
               <figure>
                  <img itemprop="image" class="owl-lazy bgoloader" data-src="<?php echo e($slider->image); ?>" title="<?php echo e($slider->title); ?>" alt="<?php echo e($slider->title); ?>" />
               </figure>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>


      <div class="owl-carousel owl-theme show-nav-hover slide-animate  d-lg-none d-sm-block  d-md-block" data-owl-options="{
         'dots': true,
           'nav': true,
           'loop': true,
            'autoplay':true,
            'autoplayTimeout':3500,
            'autoplayHoverPause':true,
            'responsiveClass':true,
            'lazyLoad': true


        }">
         <?php $__currentLoopData = $mobile_sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         <div class="banner banner3  <?php echo e($slider->device); ?>   d-md-block">
            <a href="<?php echo e($slider->link); ?>" class="d-block">
               <figure>
                  <img itemprop="image" class="owl-lazy bgoloader " data-src="<?php echo e($slider->image); ?>" title="<?php echo e($slider->title); ?>" alt="<?php echo e($slider->title); ?>" />
               </figure>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
   </section>
</div>

<div class="col-lg-3  d-none d-lg-block  d-xl-block  ">
   <div class="banner banner3 side-banner">
      <a class="d-block">
         <figure>
            <img itemprop="image" class="img-fluid bsloader" itemprop="image" title="auto parts in nigeria" src="/images/utils/ensure11.jpg" alt="banner" />
         </figure>
      </a>
   </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/slider.blade.php ENDPATH**/ ?>