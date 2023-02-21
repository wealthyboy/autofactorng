<?php $__env->startSection('content'); ?>

<div class="row">
    <?php echo $__env->make('admin.errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Add Brand</h5>
            </div>
            <div class="card-body pt-0">
                <form id="" action="<?php echo e(route('brands.store')); ?>" method="post">
                    <?php echo csrf_field(); ?> 
                    <div class="input-group input-group-outline">
                        <label class="form-label">Brand Name</label>
                        <input type="text" class="form-control"                                     
                            name="name"
                            >
                    </div>
                    <input 
                           type="hidden" 
                           class="image"                                     
                           name="image"
                           >
                    <?php echo $__env->make('admin._partials.single_image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('admin._partials.is_featured', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('backend/products.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php echo $__env->make('admin._partials.image_js',['folder' => 'brands'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/brands/create.blade.php ENDPATH**/ ?>