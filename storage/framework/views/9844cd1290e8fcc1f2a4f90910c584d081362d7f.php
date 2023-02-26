<?php $__env->startSection('content'); ?>

<div class="bg-light">

    <?php echo $__env->make('_partials.mobile_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container ">
        <div class="row mt-5">
            <?php echo $__env->make('_partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9 ">
                <wallet-table :auto_credit="false" :price_range="<?php echo e(collect([1000, 9000000])); ?>" :user="<?php echo e($user); ?>" />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/wallet/index.blade.php ENDPATH**/ ?>