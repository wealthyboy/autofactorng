<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Promo Text</h5>
            </div>
            <div class="card-body pt-0">
                <?php echo $__env->make('errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <form id="" action="" method="post">
                    <?php echo csrf_field(); ?> 
                    <div class="input-group input-group-outline">
                        <label class="form-label">TEXT</label>
                        <input 
                            type="text" 
                            class="form-control"                                     
                            name="promo"
                            required="true"
                        >
                    </div>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('inline-scripts'); ?>

<?php $__env->stopSection(); ?>


















<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/promotext/create.blade.php ENDPATH**/ ?>