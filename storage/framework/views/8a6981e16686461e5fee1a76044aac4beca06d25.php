<?php $__env->startSection('content'); ?>
<?php echo $__env->make('_partials.top_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="container-fluid">
    <!-- <div class="p-3 mb-2 bg-danger text-white text-center">Just in Autocover now available</div> -->
    <div class="row g-2">
        <?php echo $__env->make('_partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>

<div class="container-fluid">


    <?php echo $__env->make('_partials.recently_viewed_products',['name' => ' RECENTLY VIEWED & RELATED'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('_partials.auto_cover', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('_partials.categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('_partials.brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-12 text-center p-3">
            <a href="/brands" type="button" class="btn btn-outline-info">More Brands</a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('inline-scripts'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/index.blade.php ENDPATH**/ ?>