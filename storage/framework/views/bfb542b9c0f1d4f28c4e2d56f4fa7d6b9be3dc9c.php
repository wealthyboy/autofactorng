<div class="card h-100 mb-5">
    <div class="card-header ">
        <div class="row">
            <div class="col-md-6 border-bottom ">
                <h6 class="mb-0"><?php echo e($name); ?></h6>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="material-icons me-2 text-lg"></i>
            </div>
        </div>
    </div>
    <div class="card-body ">
        <ul class="list-group">

            <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                <div class="d-flex">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm"><?php echo e($key); ?></h6>
                            <span class="text-xs"><?php echo e($collection); ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                    </div>
                </div>
                <hr class="horizontal dark mt-3 mb-2">
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/_partials/single.blade.php ENDPATH**/ ?>