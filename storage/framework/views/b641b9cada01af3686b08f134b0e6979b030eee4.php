<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
   <div class="col-md-7">
      <div class="card mt-4">
         <div class="card-header">
            <h5>Edit</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="<?php echo e(route('admin.users.update',[ 'user' => $admin_user->id ])); ?>" method="post">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PATCH'); ?>
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">First Name</label>
                        <input name="first_name" value="<?php echo e($admin_user->name); ?>" type="text" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-6 col-4">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Last Name</label>
                        <input type="text" value="<?php echo e($admin_user->last_name); ?>" name="last_name" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Email address</label>
                  <input type="email" value="<?php echo e($admin_user->email); ?>" class="form-control" name="email">
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
                     <?php if(null !== $admin_user->users_permission && $permission->id == $admin_user->users_permission->permission_id): ?>
                     <option value="<?php echo e($permission->id); ?>" selected><?php echo e($permission->name); ?></option>
                     <?php else: ?>
                     <option value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                     <?php endif; ?>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>