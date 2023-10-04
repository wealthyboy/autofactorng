<?php if(null !== $global_promo): ?>
<div class="container-fluid text-center mt-3">
    <div class="row">
        <?php $__currentLoopData = $top_banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <div class="col-12">
            <div class="<?php echo e($top_banner->device); ?>">
            <img src="<?php echo e($top_banner->image); ?>" class=" img-fluid" alt="" srcset="">

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </div><!-- End .container -->
</div>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/top_banner.blade.php ENDPATH**/ ?>