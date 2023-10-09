<div class="col-md-3 d-none d-lg-block d-md-block d-xl-block mt-5  mb-5">
    <ul class="list-group list-unstyled bg-white">
        <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="<?php echo e($n['link']); ?>" class="list-group-item list-group-item-action d-flex align-items-center py-3">
                <i class="<?php echo e($n['icon']); ?>"><?php echo e($n['iconText']); ?></i>
                <span class="ms-2"><?php echo e($key); ?></span>
            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <li>
            <a href="#" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action d-flex align-items-center py-3">

                <i class="material-symbols-outlined">logout</i>
                <span class="ms-2">
                    Logout
                </span>


                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </a>

        </li>
    </ul>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav.blade.php ENDPATH**/ ?>