<?php if($featured_categories->count()): ?>
<div class="">
    <h2 class="">FEATURED CATEGORIES</h2>
    <div class="underline mb-5"></div>
</div>
<div class="row g-0">
    <?php $__currentLoopData = $featured_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div data-animation-name="fadeInUpShorter" class="col-6  col-md-3     appear-animate ">
        <a href="<?php echo e($category->link()); ?>" class="d-block p-0 border">
            <div class="d-flex justify-content-center align-items-center">
                <div class="align-self-center text-center">
                    <img src="<?php echo e($category->image); ?>" alt="" srcset="">
                    <div class="mt-4  bold"><?php echo e($category->name); ?></div>
                </div>
            </div>
        </a>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/categories.blade.php ENDPATH**/ ?>