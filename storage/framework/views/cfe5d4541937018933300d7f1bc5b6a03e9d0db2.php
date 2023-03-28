<?php $__env->startSection('content'); ?>

<div class="bg-light">
    <div class="container">
        <div class="d-block d-sm-none ">
            <?php echo $__env->make('_partials.mobile_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="container ">
        <div class="row">
            <?php echo $__env->make('_partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9 mt-5">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="page-title mb-2">Orders History</h2>
                    <div class="wallet-balance"></div>
                </div>
                <general-table class="bg-white" />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/orders/index.blade.php ENDPATH**/ ?>