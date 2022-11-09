<?php $__env->startSection('content'); ?>

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Library</li>
   </ol>
</nav>

<section class="py-5 section-elements">
   <div class="container">
      <h2 class="elements">Account</h2>
      <div class="row justify-content-center">

         <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <a href="<?php echo e($n['link']); ?>" class="icon-box nounderline">
               <i class="<?php echo e($n['icon']); ?>"><?php echo e($n['iconText']); ?></i>
               <h5 class="porto-sicon-title mx-2"><?php echo e($key); ?></h5>
            </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
   </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/account/index.blade.php ENDPATH**/ ?>