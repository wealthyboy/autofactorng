<div class="d-lg-flex mb-3">
    <div>
        <h5 class="mb-0">All <?php echo e($name); ?></h5>
    </div>
    <div class="ms-auto my-auto mt-lg-0 mt-4">
        <div class="ms-auto my-auto">
            <?php if( isset($add) ): ?>
               <a href="/admin/<?php echo e(strtolower($name)); ?>/create" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Add New</a>
            <?php endif; ?>
            <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-<?php echo e(strtolower($name)); ?>').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                Delete
            </a>
            <?php if( isset($export) ): ?>
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/includes/top.blade.php ENDPATH**/ ?>