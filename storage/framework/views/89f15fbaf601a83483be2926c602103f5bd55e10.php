<?php $__env->startSection('content'); ?>
<div class="row">
<?php echo $__env->make('admin.includes.top',['add' => true,'name' => 'Orders','delete' => false, 'export' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card mb-3">
   <div class="card-header p-3 pt-2">
      <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
         <i class="material-symbols-outlined">filter_alt</i>
      </div>
      <h6 class="mb-0">FIlter</h6>
   </div>
   <div class="card-body pt-0">
      <div class="row">
         <div class="col-sm-12 col-12">
            <div class="input-group input-group-outline">
               <label class="form-label">Order</label>
               <input name="q" type="text" class="form-control" placeholder="">
            </div>
         </div>
      </div>
      <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
         <h5 class="mb-0">Orders</h5>
         <div class="form-check">
            <label  class="custom-control-label" for="w">
            <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
            <span role="button">All</span> 
            </label>
         </div>
      </div>
   </div>
   <div class="table-responsive mt-5">
      <table class="table align-items-center mb-0">
         <thead>
            <tr>
               <th class="text">
                  <div class="form-check p-0">
                     <input class="form-check-input" type="checkbox" id="customCheck5">
                  </div>
               </th>
               <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Order Id</th>
               <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Invoice</th>
               <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">Customer</th>
               <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">Type</th>
               <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">Total</th>
               <th class="text-secondary opacity-7"></th>
            </tr>
         </thead>
         <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr>
               <td>
                  <div class="form-check  p-3 pb-0">
                     <input class="form-check-input" name="selected[]" type="checkbox" id="customCheck5">
                  </div>
               </td>
               <td>
                  <div class="d-flex px-2 py-1">
                     <?php echo e($order->id); ?>

                  </div>
               </td>
               <td>
                  <p class="text-xs font-weight-bold mb-0"><?php echo e($order->invoice); ?></p>
               </td>
               <td class="align-middle text-left text-sm">
                  <?php echo e('mam'); ?>

               </td>
               <td class="align-middle text-left">
                  <?php echo e($order->order_type); ?>

               </td>
               <td class="align-middle text-left">
                  <?php echo e($order->created_at); ?>

               </td>
               <td class="text-sm">
                  <a href="<?php echo e(route('admin.orders.show',['order'=> $order->id ])); ?>" data-bs-toggle="tooltip" data-bs-original-title="Preview order">
                    <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                  </a>
                  <a href="<?php echo e(route('order.invoice',['id'=> $order->id])); ?>" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Print invoice">
                    <i class="material-symbols-outlined  text-secondary position-relative text-lg">receipt</i>
                  </a>
                  <a href="<?php echo e(route('order.dispatch.note',['id'=> $order->id])); ?>" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Dispatch">
                    <i class="material-symbols-outlined  text-secondary position-relative text-lg">local_shipping</i>
                  </a>
               </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>
      </table>
      <div class="mt-4 mb-4 d-flex justify-content-between">
         <?php echo $__env->make('admin.includes.paginator_showing', ['name' => $orders], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>