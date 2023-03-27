<?php $__env->startSection('content'); ?>

<div class="bg-light">

    <?php echo $__env->make('_partials.mobile_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container">
        <div class="row">
            <?php echo $__env->make('_partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-5  mt-5">
                <h2>Track your order</h2>

                <track-orders />

            </div>
        </div>
    </div>

    </section>
    <!--End Contact Form & Info-->

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/tracking/index.blade.php ENDPATH**/ ?>