
<?php if(null !== $global_promo): ?>
    <div class="container-fluid text-center ">
        <div style="background-color: <?php echo e($global_promo->bgcolor); ?>" class="top-notice py-2 text-white mb-2">
            <div class="row">
                <div class="offer-hignlight ">
                    <?php $__currentLoopData = $global_promo->promo_texts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo_text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 text-center ">
                            <div class="d-inline-block  text-sm fw-bold text-white text-uppercase  mb-0"><b>
                            <?php echo e($promo_text->promo); ?></b>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div><!-- End .container -->
    </div>
<?php endif; ?>


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/top_banner.blade.php ENDPATH**/ ?>