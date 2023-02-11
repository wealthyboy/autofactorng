<div class="container d-flex justify-content-end">
    <div class="d-block d-sm-none">
        <div class="col-md-3">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined">
                        settings
                    </span>
                    Menu
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($n['link']); ?>" class="list-group-item list-group-item-action">
                            <i class="<?php echo e($n['icon']); ?>"><?php echo e($n['iconText']); ?></i>
                            <?php echo e($key); ?>

                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/mobile_nav.blade.php ENDPATH**/ ?>