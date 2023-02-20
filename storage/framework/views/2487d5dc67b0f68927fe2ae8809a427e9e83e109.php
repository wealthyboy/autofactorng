<?php if($featured_categories->count()): ?>
<div class="row mt-5">
    <h2 class="appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Featured brands
    </h2>
    <div class="underline mb-5"></div>
</div>
<div class="row g-0">
    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div data-animation-name="fadeInUpShorter" class="col-6  col-md-3     appear-animate ">
        <a href="<?php echo e($brand->link()); ?>" class="d-block p-0 border">
            <div class="d-flex justify-content-center align-items-center">
                <div class="align-self-center text-center">
                    <img src="<?php echo e($brand->image); ?>" alt="" srcset="">
                </div>
            </div>
        </a>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/brands.blade.php ENDPATH**/ ?>