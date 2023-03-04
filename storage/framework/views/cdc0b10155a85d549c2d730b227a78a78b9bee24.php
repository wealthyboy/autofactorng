<?php $__env->startSection('content'); ?>



<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12  mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($category->name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="">
            <h1 class="text-uppercase p-0"><?php echo e(optional($category)->name); ?></h1>
        </div>
        <products-items :search_filters="<?php echo e($search_filters); ?>" />
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/products/index.blade.php ENDPATH**/ ?>