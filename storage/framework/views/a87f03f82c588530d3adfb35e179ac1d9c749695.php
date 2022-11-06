<?php $__env->startSection('content'); ?>
<div class="row">
   <?php echo $__env->make('admin.errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">list</i>
            </div>
            <h6 class="mb-0">Edit </h6>
         </div>
         <div class="card-body pt-0">
            <form action="<?php echo e(route('category.update',['category' => $cat->id ])); ?>" method="post">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PATCH'); ?>
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input class="form-control" name="name" type="text" value="<?php echo e($cat->name); ?>" required="true" />
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Sort order</label>
                        <input class="form-control" name="sort_order" type="text" value="<?php echo e($cat->sort_order); ?>" />
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Custom Link</label>
                        <input type="text" class="form-control" name="custom_link" type="text" value="<?php echo e($cat->link); ?>">
                        <input type="hidden" class="image" name="image" value="<?php echo e($cat->image); ?>">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control" name="meta_title">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Keywords</label>
                        <input type="text" class="form-control" name="keywords" type="text" value="<?php echo e($cat->keywords); ?>">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Description</label>

                        <textarea type="text" class="form-control" name="description" rows="8"><?php echo e($cat->description); ?></textarea>

                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="parent_id" id="">
                           <option value="">--Choose Parent--</option>
                           <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if($cat->parent_id == $category->id ): ?>
                           <option class="" value="<?php echo e($category->id); ?>" selected="selected"><?php echo e($category->name); ?> </option>
                           <?php echo $__env->make('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php else: ?>
                           <option class="" value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?> </option>
                           <?php echo $__env->make('includes.children_options',['model' => $cat,'obj'=>$category,'space'=>'&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="search_type" id="">
                           <option value="">--Choose Search-- </option>
                           <option <?php echo e($cat->search_type == 'make_model_year' ? 'selected' :  ""); ?> value="make_model_year">Make Model Year</option>
                           <option <?php echo e($cat->search_type == 'tyre' ?  'selected' :  ""); ?> value="tyre">Tyre</option>
                           <option <?php echo e($cat->search_type == 'battery' ?  'selected' :  ""); ?> value="battery">Battery</option>
                        </select>
                     </div>
                  </div>
               </div>
               <?php echo $__env->make('admin._partials.single_image',['model' => $cat], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

               <?php echo $__env->make('admin._partials.is_featured', ['model' => $cat], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
               </div>
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


<?php echo $__env->make('admin._partials.image_js',['folder' => 'category'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/category/edit.blade.php ENDPATH**/ ?>