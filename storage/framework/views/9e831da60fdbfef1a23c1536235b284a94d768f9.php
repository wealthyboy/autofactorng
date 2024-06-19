<?php if($featured_categories->count()): ?>
<div class="row">
    <h2 class=" mb-0 mb-3 display-4">FEATURED <strong>CATEGORIES</strong> </h2>
    <div class="underline mb-5 ms-3"></div>
</div>
<div title="shop all categories " class="row g-0">
    <?php $__currentLoopData = $featured_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div data-animation-name="fadeInUpShorter" itemscope itemtype="https://schema.org/category" class="col-6 col-lg-3 col-md-6 appear-animate">
        <a href="<?php echo e($category->link()); ?>" class="d-block p-0 border category-content  py-5 no-hover" itemscope itemtype="https://schema.org/Text">
            <div class="d-flex justify-content-center align-items-center">
                <div class="align-self-center text-center">
                    <div title="<?php echo e($category->name); ?> category" class="image-category">
                        <img data-src="<?php echo e($category->image); ?>" class="image-class" alt="<?php echo e($category->name); ?>" tittle="shop for <?php echo e($category->name); ?> in nigeria">
                    </div>
                </div>

            </div>
            <div class="text-center">
                <div itemprop="name" title="shop for <?php echo e($category->name); ?>" class="mt-1 semi-bold fs-3"><?php echo e($category->name); ?></div>
            </div>
        </a>

    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/categories.blade.php ENDPATH**/ ?>