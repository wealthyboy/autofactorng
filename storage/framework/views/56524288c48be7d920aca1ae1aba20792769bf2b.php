<?php $__env->startSection('content'); ?>
<div class="row">
<?php echo $__env->make('admin.includes.top',['name' => 'Banners','add' => true,'delete' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
   <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
         <h5 class="mb-0">Banners</h5>
         <div class="form-check">
            <label  class="custom-control-label" for="w">
            <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
            <span role="button">All</span> 
            </label>
         </div>
      </div>
   </div>
   <div class="table-responsive mt-5">
      <form action="<?php echo e(route('banners.destroy',['banner' => 1])); ?>" method="post" enctype="multipart/form-data" id="form-banners">
         <?php echo csrf_field(); ?>
         <?php echo method_field('DELETE'); ?>
         <table class="table align-items-center mb-0">
            <thead>
               <tr>
                  <th class="text">
                     <div class="form-check p-0">
                        <input class="form-check-input" type="checkbox" id="customCheck5">
                     </div>
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">IMAGE</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">TITLE</th>
                  <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">LINK</th>
                  <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">SORT ORDER</th>
                  <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder ">ACTIONS</th>
               </tr>
            </thead>
            <tbody>
               <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
               <tr>
                  <td>
                     <div class="form-check  p-3 pb-0">
                        <input class="form-check-input" name="selected[]" value="<?php echo e($banner->id); ?>" type="checkbox" id="customCheck5">
                     </div>
                  </td>
                  <td>
                     <div class="d-flex">
                        <img class="w-10 ms-3" src="<?php echo e($banner->image); ?>" alt="fendi">
                     </div>
                  </td>
                  <td class="align-middle text-left">
                     <?php echo e($banner->title); ?>

                  </td>
                  <td>
                     <p class="text-xs font-weight-bold mb-0"><?php echo e($banner->link); ?></p>
                  </td>
                  <td class="align-middle text-left text-sm">
                     <?php echo e($banner->sort_order); ?>

                  </td>
                  <td class="text-sm">
                     <a href="<?php echo e(route('banners.edit',['banner'=> $banner->id ])); ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                     <i class="material-symbols-outlined text-secondary position-relative text-lg">edit</i>
                     </a>
                  </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>
      </form>
      <div class="mt-4 mb-4 d-flex justify-content-between">
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/banners/index.blade.php ENDPATH**/ ?>