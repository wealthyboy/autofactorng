<?php if($featured_categories->count()): ?>

<div class="row mt-5">
    <h2 class="appear-animate mb-0 mb-3" data-animation-delay="100" data-animation-name="fadeInUpShorter">FEATURED <strong>BRANDS</strong> </h2>
    <div class="underline mb-5 ms-3"></div>
</div>
<div class="row g-0">
    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div itemscope itemtype="https://schema.org/Brand" data-animation-name="fadeInUpShorter" class="col-6  col-md-3     appear-animate ">
        <a class="d-block p-0 border">
            <div class="d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center text-center image-category">
                    <img itemprop="image" title="We have genuine <?php echo e($brand->name); ?> for you" src="<?php echo e($brand->image); ?>" alt="<?php echo e($brand->name); ?> ">
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/brands.blade.php ENDPATH**/ ?>