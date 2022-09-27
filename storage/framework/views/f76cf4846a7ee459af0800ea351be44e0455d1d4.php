    <div class="results ">
        <?php echo __('Showing'); ?>

        <?php if($name->firstItem()): ?>
            <span class="font-medium"><?php echo e($name->firstItem()); ?></span>
            <?php echo __('to'); ?>

            <span class="font-medium"><?php echo e($name->lastItem()); ?></span>
        <?php else: ?>
            <?php echo e($name->count()); ?>

        <?php endif; ?>
        <?php echo __('of'); ?>

        <span class="font-medium"><?php echo e($name->total()); ?></span>
        <?php echo __('results'); ?>

    </div>
    <?php echo e($name->links('vendor.pagination.bootstrap-4')); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/includes/paginator_showing.blade.php ENDPATH**/ ?>