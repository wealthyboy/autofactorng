<div class="row ">
    <?php $__currentLoopData = $footer_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-sm-4 col-6 col-lg-4">
        <div class="widget">
            <h2 class="widget-title text-white mb-"><?php echo e(title_case($info->name)); ?></h2>
            <?php if($info->children->count()): ?>
            <ul class="links text-secondry list-unstyled">
                <?php $__currentLoopData = $info->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="py-3">
                    <a href="<?php echo e($info->c_link); ?>">
                        <?php echo e($info->name); ?>

                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>

        </div><!-- End .widget -->
    </div><!-- End .col-sm-6 -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div><!-- End .row --><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/layouts/footer/desktop_footer.blade.php ENDPATH**/ ?>