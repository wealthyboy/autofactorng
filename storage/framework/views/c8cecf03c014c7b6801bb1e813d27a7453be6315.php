<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <button type="button" class=" text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        <ul class="list-unstyled pl-3">
            <?php $__currentLoopData = $global_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e($category->link ? $category->link : '/products/'.$category->slug); ?>" target="" data-testid="at_popular_part_list_item_0" tabindex="0">
                    <div class="az_ylb">
                        <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                            <div class="az_-i"><?php echo e($category->name); ?></div>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

    </div>

</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav_categories.blade.php ENDPATH**/ ?>