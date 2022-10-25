<h2 class="appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Featured brands
</h2>

<div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">

    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div data-animation-name="fadeInUpShorter" class="col-6 col-sm-4 col-md-3  border  appear-animate col-lg-2">
        <div class="d-flex icon-box justify-content-center align-items-center">
            <a href="<?php echo e($brand->link()); ?>" class="">
                <img src="<?php echo e($brand->image); ?>" alt="" srcset="">
            </a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/brands.blade.php ENDPATH**/ ?>