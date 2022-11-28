<div class="col-md-3 d-none d-lg-block d-md-block d-xl-block">
    <ul class="list-group list-unstyled">
        <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="<?php echo e($n['link']); ?>" class="list-group-item list-group-item-action">
                <i class="<?php echo e($n['icon']); ?>"><?php echo e($n['iconText']); ?></i>
                <?php echo e($key); ?>

            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <li>
            <a href="#" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action "><i class="fas fa-sign-out-alt left"></i> Logout


                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </a>

        </li>
    </ul>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav.blade.php ENDPATH**/ ?>