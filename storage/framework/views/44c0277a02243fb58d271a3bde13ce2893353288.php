<div class="container d-flex justify-content-end">
    <div class="d-block d-sm-none">
        <div class="col-12 w-100 p-0">
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined me-2">
                        settings
                    </span>
                    <span>Menu</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="py-3">
                        <a href="<?php echo e($n['link']); ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="<?php echo e($n['icon']); ?>"><?php echo e($n['iconText']); ?></i>
                            <span class="ms-2"><?php echo e($key); ?></span>
                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/mobile_nav.blade.php ENDPATH**/ ?>