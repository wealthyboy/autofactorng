<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="alert alert-info text-white">
      <span><strong>Code: 1 Account ,2 Create , 3 Read , 4 Update ,5 Delete, 6 Reports, 7 Users, 8 Activity, 9 Enable/Disble, 10 Permission</strong></span>
   </div>
   <?php echo $__env->make('admin._partials.t', ['models' => $permissions, 'name' => 'Permissions'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/permissions/index.blade.php ENDPATH**/ ?>