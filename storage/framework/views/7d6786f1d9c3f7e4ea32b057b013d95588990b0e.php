<div class="row ">
    <?php $__currentLoopData = $footer_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-sm-4 col-6 col-lg-4">
        <div class="widget">
            <h2 class="widget-title text-white"><?php echo e(title_case($info->name)); ?></h2>
            <?php if($info->children->count()): ?>
            <ul class="links text-white list-unstyled">
                <?php $__currentLoopData = $info->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
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

    <div class="col-lg-4 col-sm-4">
        <div class="widget">
            <h4 class="widget-title text-white">Guide</h4>

            <ul class="links text-white list-unstyled">
                <li><a href="dashboard.html">My Account</a></li>
                <li><a href="#">Track Your Order</a></li>
                <li><a href="#">Payment Methods</a></li>
                <li><a href="#">Shipping Guide</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Product Support</a></li>
                <li><a href="#">Privacy</a></li>
            </ul>
        </div><!-- End .widget -->
    </div><!-- End .col-lg-2 -->

    <div class="col-lg-4 col-sm-4">
        <div class="widget">
            <h4 class="widget-title text-white">Know Us</h4>

            <ul class="links  list-unstyled">
                <li><a href="about.html">About </a></li>
                <li><a href="#">Our Guarantees</a></li>
                <li><a href="#">Terms And Conditions</a></li>
                <li><a href="#">Privacy policy</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Intellectual Property Claims</a></li>
                <li><a href="#">Site Map</a></li>
            </ul>
        </div><!-- End .widget -->
    </div><!-- End .col-lg-3 -->

    <div class="col-lg-4 col-sm-4">
        <div class="widget">
            <h4 class="widget-title text-white">Help</h4>

            <ul class="links list-unstyled">
                <li><a href="about.html">About </a></li>
                <li><a href="#">Our Guarantees</a></li>
                <li><a href="#">Terms And Conditions</a></li>
                <li><a href="#">Privacy policy</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Intellectual Property Claims</a></li>
                <li><a href="#">Site Map</a></li>
            </ul>
        </div><!-- End .widget -->
    </div><!-- End .col-lg-2 -->
</div><!-- End .row --><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/layouts/footer/desktop_footer.blade.php ENDPATH**/ ?>