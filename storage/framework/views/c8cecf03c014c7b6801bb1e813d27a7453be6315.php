<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <a type="button" class="panel-close border-0 bg-transparent bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/images/utils/close-dark.svg" class="p-3" alt="" srcset="">
        </a>
    </div>
    <div class="offcanvas-body p-0">
        <div class="accordion accordion-flush" id="accordionNav">
            <?php $__currentLoopData = $global_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?php echo e($category->id); ?>">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo e($category->id); ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo e($category->id); ?>">
                        <?php echo e($category->name); ?>

                    </button>
                </h2>
                <div id="flush-collapse<?php echo e($category->id); ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo e($category->id); ?>" data-bs-parent="#accordionNav">
                    <div class="accordion-body">
                        <?php if($category->isCategoryHaveMultipleChildren()): ?>
                        <ul>
                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li class="py-4">
                                <a href="/products/<?php echo e($children->slug); ?>" class="category-heading"><?php echo e($children->name); ?> </a>
                                <?php if($children->children->count()): ?>
                                <ul>
                                    <?php $__currentLoopData = $children->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="/products/<?php echo e($children->slug); ?>"><?php echo e($children->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php elseif( !$category->isCategoryHaveMultipleChildren() && $category->children->count() ): ?>
                        <ul>
                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="category-heading" href="/products/<?php echo e($children->slug); ?>"><?php echo e($children->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </div>


    </div>

</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav_categories.blade.php ENDPATH**/ ?>