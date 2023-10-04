<div class="col-md-12 col-lg-9">
   <section class="slider-loader" style="background:#ccc; height: 450px;">
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
                  <img class="owl-lazy" data-src="<?php echo e($slider->image); ?>" style="background:radial-gradient(circle at 1.2% 5%, rgb(255, 94, 157) 34.7%, rgb(255, 78, 6) 92.3%);;min-height:36rem;" alt="banner" />
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
                  <img class="owl-lazy" data-src="<?php echo e($slider->image); ?>" style="background:radial-gradient(circle at 1.2% 5%, rgb(255, 94, 157) 34.7%, rgb(255, 78, 6) 92.3%);min-height:36rem;" alt="banner" />
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
            <img class="img-fluid" src="/images/utils/ensure11.jpg" style="background:#f6e1e8;" alt="banner" />
         </figure>
      </a>
   </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/slider.blade.php ENDPATH**/ ?>