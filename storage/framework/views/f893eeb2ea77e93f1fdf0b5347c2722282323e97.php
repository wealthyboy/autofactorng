<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('admin._partials.t', ['models' => $brands, 'name' => 'Brands'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/brands/index.blade.php ENDPATH**/ ?>