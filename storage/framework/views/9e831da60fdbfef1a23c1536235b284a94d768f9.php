<?php if($featured_categories->count()): ?>
<div class="row">
    <h2 class=" mb-0 mb-3 display-4">FEATURED <strong>CATEGORIES</strong> </h2>
    <div class="underline mb-5 ms-3"></div>
</div>
<div class="row g-0">
    <?php $__currentLoopData = $featured_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div data-animation-name="fadeInUpShorter" class="col-6  col-md-3     appear-animate ">
        <a href="<?php echo e($category->link()); ?>" class="d-block p-0 border  py-5">
            <div class="d-flex justify-content-center align-items-center">
                <div class="align-self-center text-center">
                    <div class="image-category">
                        <img src="<?php echo e($category->image); ?>" alt="" srcset="">
                    </div>
                </div>

            </div>
            <div class="text-center">
                <div class="mt-1 semi-bold fs-3"><?php echo e($category->name); ?></div>
            </div>
        </a>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/categories.blade.php ENDPATH**/ ?>