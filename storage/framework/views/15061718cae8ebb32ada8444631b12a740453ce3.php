<?php $__env->startSection('content'); ?>
<section class="bg--gray">
    <div id="full-bg" class="full-bg">
        <div class="signup--middle">
            <div class="loading">
                <div class="loader"></div>
            </div>
            <img src="<?php echo e($system_settings->logo_path()); ?>" height="110" width="80" alt="<?php echo e(Config('app.name')); ?>  Logo">
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/checkout/index.blade.php ENDPATH**/ ?>