<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <button type="button" class="panel-close border-0 bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/images/utils/close-dark.svg" class="p-3" alt="" srcset="">
        </button>
    </div>
    <div class="offcanvas-body ">
        <ul class="list-unstyled pl-3">
            <?php $__currentLoopData = $global_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e($category->children->count() ? '#' : '/products/'.$category->slug); ?>" target="" data-testid="at_popular_part_list_item_0" tabindex="0">
                    <div class="az_ylb">
                        <div class="" tabindex="-1" role="menuitem" aria-disabled="false">
                            <h5 class="mb-0 text-uppercase fs-3"><?php echo e($category->name); ?></h5>
                        </div>
                    </div>
                </a>

                <?php if($category->children->count()): ?>
                <ul>
                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="py-3">
                        <a href="<?php echo e($category->link ? $category->link : '/products/'.$category->slug); ?>">

                            <?php echo e($category->name); ?>

                        </a>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php else: ?>
                <ul>
                    <li class="py-3">
                        <a href="<?php echo e($category->children->count() ? '#' : '/products/'.$category->slug); ?>">
                            All <?php echo e($category->name); ?>

                        </a>

                    </li>
                </ul>
                <?php endif; ?>

            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

    </div>

</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav_categories.blade.php ENDPATH**/ ?>