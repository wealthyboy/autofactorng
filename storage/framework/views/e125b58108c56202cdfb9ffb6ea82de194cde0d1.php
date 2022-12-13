<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
   <div class="col-md-7">
      <div class="card mt-4" id="password">
         <div class="card-header">
            <h5>Add User</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="<?php echo e(route('admin.users.store')); ?>" method="post">
               <?php echo csrf_field(); ?>
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">First Name</label>
                        <input name="first_name" type="text" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-6 col-4">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email">
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password">
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="permission_id" id="">
                     <option value="">--Choose Permission--</option>
                     <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Save</button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/users/create.blade.php ENDPATH**/ ?>