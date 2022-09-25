<div class="col-md-9 ">
   <div id="au-slider" class="carousel slide" data-bs-ride="carousel">
      <?php if($sliders->count() > 1): ?>
         <div class="carousel-indicators">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <button type="button" data-bs-target="#au-slider" data-bs-slide-to="<?php echo e($key); ?>" class="<?php echo e($key == 0 ?  'active' : ''); ?>  <?php echo e($slider->device); ?> " aria-current="true" aria-label="Slide <?php echo e($key); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
      <?php endif; ?>

      <div class="carousel-inner">
         <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ?  'active' : ''); ?>  <?php echo e($slider->device); ?> ">
               <a href="<?php echo e($slider->link); ?>">
                  <img src="<?php echo e($slider->image); ?>" class="w-100" alt="...">
               </a>
            </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php if($sliders->count() > 1): ?>

      <button class="carousel-control-prev" type="button" data-bs-target="#sau-lider" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#au-slider" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
      </button>
      <?php endif; ?>

   </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/slider.blade.php ENDPATH**/ ?>