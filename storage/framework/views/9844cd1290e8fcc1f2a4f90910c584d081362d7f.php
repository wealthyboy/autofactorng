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
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="page-title ">Wallet</h2>
                    <div class="wallet-balance">Balance: 0</div>
                </div>
                <?php echo $__env->make('_partials.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>
<!--End Contact Form & Info-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/wallet/index.blade.php ENDPATH**/ ?>