<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-6">
      <div class="card mt-4" id="password">
         <div class="card-header">
            <h5>Add Permission</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="<?php echo e(route('permissions.update',['permission' => $permission->id ])); ?>" method="post">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PATCH'); ?>
               <div class="input-group input-group-outline">
                  <label class="form-label">Permissions</label>
                  <input type="text" class="form-control"                                     
                     name="name"
                     value="<?php echo e($permission->name); ?>"
                     required="true"
                     >
               </div>
               <div class="mt-3">
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check pl-0 p-0">
                            <label  class="custom-control-label" for="<?php echo e($value); ?>">
                            <input  <?php echo e(str_contains($permission->code, $value) ? 'checked' : ''); ?>  class="form-check-input" name="code[]" value="<?php echo e($value); ?>"  id="<?php echo e($value); ?>" type="checkbox">
                            <span role="button"><?php echo e($key); ?></span> 
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/permissions/edit.blade.php ENDPATH**/ ?>