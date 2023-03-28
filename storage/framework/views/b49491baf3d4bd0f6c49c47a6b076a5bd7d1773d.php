<div class="col-md-9 ">
   <section class="p-0">

      <div class="owl-carousel owl-theme show-nav-hover slide-animate" data-owl-options="{
           'dots': true,
           'nav': true,
           'loop': false
        }">
         <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         <div class="banner banner3">
            <a href="" class="d-block">
               <figure>
                  <img width="1920" height="700" src="<?php echo e($slider->image); ?>" style="background:#f6e1e8;min-height:36rem;" alt="banner" />
               </figure>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
   </section>
</div>

<div class="col-md-3  d-none d-lg-block d-md-block d-xl-block  ">
   <div class="banner banner3">
      <a href="/" class="d-block">
         <figure>
            <img class="img-fluid" src="/images/utils/ensure_11.jpg" style="background:#f6e1e8;" alt="banner" />
         </figure>
      </a>
   </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/slider.blade.php ENDPATH**/ ?>