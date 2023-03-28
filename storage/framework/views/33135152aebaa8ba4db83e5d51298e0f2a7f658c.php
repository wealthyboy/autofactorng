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
                     <br /><?php echo e($order->state); ?>&nbsp;
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="row">
   <?php echo $__env->make('admin._partials.t', ['models' => $orders, 'name' => 'Items'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <div class="card mt-3">
      <div class="card-header p-3 pt-2">
         <h6 class="mb-0">Update Status</h6>
      </div>
      <div class="card-body  pt-0">

         <form action="#" class="status-form" method="post">
            <?php echo csrf_field(); ?>
            <div class="row mt-3">

               <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>" type="text">
               <div class="col-3">
                  <select name="status" id="order-status" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                     <option value="">Choose Status</option>
                     <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if($status == $order->status): ?>
                     <option value="<?php echo e($status); ?>" selected><?php echo e($status); ?></option>
                     <?php else: ?>
                     <option value="<?php echo e($status); ?>"><?php echo e($status); ?></option>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </select>

               </div>

            </div>

         </form>
      </div>
   </div>
   <!--  end card  -->
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>

$("#order-status").on('change',function(e){
e.preventDefault()
if($(this).val() == ''){
return;
}
$.ajax({
type: "POST",
url: "/admin/orders/status",
data: $('.status-form').serialize(),
}).done(function(response){
}).fail(function(){
})

})
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/orders/show.blade.php ENDPATH**/ ?>