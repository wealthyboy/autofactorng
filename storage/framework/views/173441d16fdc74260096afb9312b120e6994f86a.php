<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-7">  
    <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
              <i class="material-symbols-outlined">filter_alt</i>
          </div>
          <h6 class="mb-0">Add Shipping</h6>
        </div>
        <div class="card-body pt-0">
            <form action="<?php echo e(route('shipping.update',['shipping' => $shipping->id])); ?>" method="post" enctype="multipart/form-data" id="form-shipping">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="row mt-3">
                    <div class="col-sm-12 col-12">
                      <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input type="text" 
                              required 
                              class="form-control" 
                              name="name"
                              value="<?php echo e($shipping->name ?? old('name')); ?>"
                            >
                      </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 col-12">
                      <div class="input-group input-group-outline">
                        <label class="form-label"> Price</label>
                        <input type="text" 
                               
                              class="form-control" 
                              name="price"
                              value="<?php echo e($shipping->price ?? old('price')); ?>"
                            >
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label mt-4 ms-0"> </label>
                                    <select required class="form-control" name="location_id" id="">
                                        <option  value="">--Choose Type--</option>
                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php if( $shipping->location_id == $location->id): ?>
                                            <option value="<?php echo e($location->id); ?>" selected> <?php echo e($location->name); ?> </option>
                                                <?php else: ?>
                                            <option value="<?php echo e($location->id); ?>"> <?php echo e($location->name); ?> </option>
                                          <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-12">
                                <div class="input-group input-group-outline">
                                    <label class="form-label mt-4 ms-0"> </label>
                                    <select  class="form-control" name="parent_id" id="">
                                        <option  value="">--Choose Type--</option>
                                        <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($shipping->parent_id == $ship->id ): ?>
                                                <option  value="<?php echo e($ship->id); ?>" selected="selected"><?php echo e($ship->name); ?> </option>                                        
                                                <?php echo $__env->make('includes.children_options',['obj'=>$ship,'space'=>'&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php else: ?>
                                                <option  value="<?php echo e($ship->id); ?>" ><?php echo e($ship->name); ?> </option>
                                                <?php echo $__env->make('includes.children_options',['model' => $shipping,'obj'=>$shipping,'space'=>'&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

          
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
                </div>
          </form>
        </div>
    </div>
  </div>

 
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
   var parent_id = document.getElementById('parent_id');
   setTimeout(function () {
      const example = new Choices(parent_id);
   }, 1);
   
<?php $__env->stopSection(); ?>







<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/shipping/edit.blade.php ENDPATH**/ ?>