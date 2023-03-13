<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <a type="button" class="panel-close border-0 bg-transparent bg-transparent" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="/images/utils/close-dark.svg" class="p-3" alt="" srcset="">
        </a>
    </div>
    <div class="offcanvas-body ">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Accordion Item #2
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                </div>
            </div>

        </div>
        <div class="mobile-m">
            <div class="mobile-menu-wrapper">
                <div class="d-flex border-bottom justify-content-between p-4">
                    <div class="menu">Menu</div>
                    <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
                </div>
                <nav class="mobile-nav">
                    <div class="d-flex  border-bottom   px-4  justify-content-between">

                    </div>

                    <ul class="mobile-menu mt-3">
                        <?php $__currentLoopData = $global_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a class="" href="<?php echo e($category->children->count() ? '#' : '/products/'.$category->slug); ?>"><?php echo e($category->name); ?></a>
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
                        </li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                </nav>
                <!-- End .mobile-nav -->

            </div>
            <!-- End .mobile-menu-wrapper -->
        </div>

    </div>

</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav_categories.blade.php ENDPATH**/ ?>