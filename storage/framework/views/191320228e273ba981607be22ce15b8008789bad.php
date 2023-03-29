 

 <?php $__env->startSection('content'); ?>
 <section class="header container-fluid py-5">
     <h4 class="text-uppercase  mb-0 mb-3 display-4"> MY <strong> CART </strong></h4>
 </section>



 <!--Content-->

 <section class="bg-light">
     <div class="container-fluid ">
         <cart-summary />
     </div>

 </section>
 <!--End Content-->
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/carts/index.blade.php ENDPATH**/ ?>