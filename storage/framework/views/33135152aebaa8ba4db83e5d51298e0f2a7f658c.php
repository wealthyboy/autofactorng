<?php $__env->startSection('page-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row mb-3">
   <div class="col-md-6">
      <?php echo $__env->make('admin._partials.single', ['collections' => $objs['customer'], 'name' => 'Order Details'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </div>
   <div class="col-md-6">
      <?php echo $__env->make('admin._partials.single', ['collections' => $objs['Order'], 'name' => 'Customer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </div>
</div>
<div class="row mb-2">
   <div class="card h-100">
      <div class="card-body p-3">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <h4 class="card-title">Shipping Address</h4>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td class="text-left" data-link-style="text-decoration:none; color:#67bffd;">
                     <?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?> <br />
                     <?php echo e($order->address); ?><br /> <?php echo e($order->city); ?> &nbsp;
                     <br /> <?php echo e($order->state); ?>&nbsp;
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="row">
   <?php echo $__env->make('admin._partials.t', ['models' => $orders, 'name' => 'Items'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
$(document).ready(function(){

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/orders/show.blade.php ENDPATH**/ ?>