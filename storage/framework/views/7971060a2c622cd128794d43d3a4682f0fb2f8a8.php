 
<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">receipt</i>
            </div>
            <h6 class="mb-0">Edit</h6>
         </div>
         <div class="card-body pt-0">
            <form action="<?php echo e(route('vouchers.update',['voucher' => $voucher->id ])); ?>" method="post">
                <?php echo method_field('PATCH'); ?>
                <?php echo csrf_field(); ?>
                <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Coupon Code</label>
                        <input name="code" type="code" value="<?php echo e($voucher->code); ?>" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-4 col-4">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Discount (in %)</label>
                        <input type="number" value="<?php echo e($voucher->amount); ?>"  name="discount" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Expires </label>
                        <input name="expires" value="<?php echo e($voucher->expires); ?>"  class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="">
                     <div class="row">
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label">From Value</label>
                              <input type="number" value="<?php echo e($voucher->from_value); ?>" name="from_value"  class="form-control" placeholder="">
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label mt-4 ms-0"> </label>
                              <select class="form-control" name="type" id="">
                                 <option  value="">--Choose Type--</option>
                                 <option  <?php echo e($voucher->type == 'specific user' ? 'selected' : ''); ?> value="specific user">One User</option>
                                 <option  <?php echo e($voucher->type == 'general' ? 'selected' : ''); ?> value="general">Multiple User</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-4 col-12">
                           <div class="input-group input-group-outline">
                              <label class="form-label mt-4 ms-0"> </label>
                              <select class="form-control" name="status" id="">
                                 <option  value="">--Choose Status--</option>
                                 <option  value="1" <?php echo e($voucher->status == 1 ? 'selected' : ''); ?>>Active</option>
                                 <option  value="0" <?php echo e($voucher->status == 0 ? 'selected' : ''); ?>>Deactivate</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="form-check my-3 mb-3">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2">
                     <label class="custom-control-label"  <?php echo e(!$voucher->is_fixed ? 'checked' : null); ?>  name="is_fixed" value="0"  role="button"   for="customRadio2">Percentage</label>
                  </div>

                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
                     <label class="custom-control-label" name="is_fixed"  <?php echo e($voucher->is_fixed ? 'checked' : null); ?>  checked value="1" role="button" for="customRadio1">Fixed</label>
                  </div>
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Submit</button>
            </form>
         </div>
      </div>
      <!--  end card  -->
   </div>
   <!-- end col-md-12 -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('inline-scripts'); ?>
if (document.querySelector('.datetimepicker')) {
    flatpickr('.datetimepicker', {
       allowInput: true
    }); // flatpickr
}
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/vouchers/edit.blade.php ENDPATH**/ ?>