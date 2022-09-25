<div class="row mt-5 no-gutters">
    <div>
        <h2 class="">BRANDS WE TRUST</h2>
        <div class="underline mb-5"></div>
    </div>
    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3 border  col-6 text-center">
        <div class="category-content d-flex justify-content-center align-items-center">
        <a href="<?php echo e($brand->link()); ?>" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
            <div class="category-image"><img src="<?php echo e($brand->image); ?>" alt="" srcset="" class="img-fluid"></div>
        </a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/brands.blade.php ENDPATH**/ ?>