<?php $__env->startSection('content'); ?>

<section class="my-5">
    <div class="container">
        <div class="d-block d-sm-none">
            <?php echo $__env->make('_partials.mobile_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="container ">
        <div class="row">

            <?php echo $__env->make('_partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="col-md-9">
                <wallet-table :user="<?php echo e($user); ?>" />
            </div>
        </div>
    </div>
</section>
<!--End Contact Form & Info-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/wallet/index.blade.php ENDPATH**/ ?>