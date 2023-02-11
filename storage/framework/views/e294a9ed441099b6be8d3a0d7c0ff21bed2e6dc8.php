<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-7">
      <div class="card mt-4" id="password">
         <div class="card-header">
            <h5>Add Banner</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="<?php echo e(route('banners.store')); ?>" method="post">
               <?php echo csrf_field(); ?>
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-6 col-4">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Sort Order</label>
                        <input type="number"  name="sort_order" class="form-control">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Image Alt tag</label>
                        <input type="text" class="form-control" name="img_alt">
                     </div>
                  </div>

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Class</label>
                        <input type="text" class="form-control" name="class">
                     </div>
                  </div>
               </div>

               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Link</label>
                  <input type="text" class="form-control" name="link">
                  <input type="hidden" class="images" name="image">

               </div>

               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="col_width" id="">
                     <option  value="">--Choose Cols--</option>
                     <?php $__currentLoopData = $cols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <option value="<?php echo e($col); ?>"><?php echo e($col); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    
                  </select>
               </div>

               <div class="input-group input-group-outline mt-3">
                  <select name="device" class="form-control select2" style="width: 100%;">
                     <option value="" selected="selected">--device--</option>
                     <option value="d-block d-sm-none">Show only on sm devices </option>
                     <option value="d-none d-lg-block d-xl-block">Show only on lg devices </option>
                  </select>
               </div>

              
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="type" id="">
                     <option value="" selected="selected">--Choose Type--</option>
                     <option value="slider">Slider</option>
                     <option value="banner">Banner</option>
                    
                  </select>
               </div>
               <?php echo $__env->make('admin._partials.single_image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Submit</button>
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
<?php echo $__env->make('admin._partials.image_js',['folder' => 'banners'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/banners/create.blade.php ENDPATH**/ ?>