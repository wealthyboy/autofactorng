<?php if($featured_categories->count()): ?>
<div class="row mt-5">
    <div class="">
        <h2 class="">FEATURED CATEGORIES</h2>
        <div class="underline mb-5"></div>
    </div>
    <?php $__currentLoopData = $featured_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3 border  col-6 text-center">
        <div class="category-content d-flex justify-content-center align-items-center">
            <a href="<?php echo e($category->link()); ?>" class="category-link category-link  d-flex flex-column justify-content-around align-items-center">
            <div class="category-image"><img src="<?php echo e($category->image); ?>" alt="" srcset="" class="img-fluid"></div>
            <div class="mt-4  bold"><?php echo e($category->name); ?></div>
            </a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/categories.blade.php ENDPATH**/ ?>