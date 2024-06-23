<?php $__env->startSection('content'); ?>

<div class="row">
<?php echo $__env->make('admin.errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body pt-0">
                <form id="" action="<?php echo e(route('brands.update',['brand' => $brand->id])); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="input-group input-group-outline">
                        <label class="form-label">Brand Name</label>
                        <input type="text" class="form-control"                                     
                            name="name"
                            value="<?php echo e($brand->name); ?>"
                            required
                            >
                    </div>

                    <input 
                        type="hidden" 
                        class="image"                                     
                        name="image"
                        value="<?php echo e($brand->image); ?>"
                    >
                    <?php echo $__env->make('admin._partials.single_image',['model' => $brand], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('admin._partials.is_featured', ['model' =>  $brand], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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






<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/brands/edit.blade.php ENDPATH**/ ?>