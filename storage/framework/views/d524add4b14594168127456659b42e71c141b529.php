<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Add Promo</h5>
            </div>
            <div class="card-body pt-0">
                <?php echo $__env->make('errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <form id="" action="<?php echo e(route('promos.update',['promo' =>  $promo->id ])); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                    <div class="input-group input-group-outline">
                        <label class="form-label">Promo  Background Color</label>
                        <input 
                            type="text" 
                            class="form-control"                                     
                            name="background_color"
                            required="true"
                            value="<?php echo e($promo->bgcolor); ?>"
                        >
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input <?php echo e($promo->is_active == 1 ? 'checked' : ''); ?>  class="form-check-input"  name="is_active" value="1" type="checkbox" id="is_active">
                                <label class="form-check-label" for="is_active">Enable/Disable</label>
                            </div>
                        </div>
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


















<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/promo/edit.blade.php ENDPATH**/ ?>