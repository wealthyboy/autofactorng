<?php $__env->startSection('pagespecificstyles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
         <a href="/admin/reviews" rel="tooltip" title="Back" class="btn btn-primary btn-simple btn-xs">
            <i class="material-icons">reply</i>
         </a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <h4 class="">Product <?php echo e(optional($review->product)->product_name); ?></h4>
            <a href="/admin/reviews?id=<?php echo e($review->id); ?>&accept=<?php echo e($review->is_verified ? 0 : 1); ?>"><?php echo e($review->is_verified == true ?   'Approved' : "Approve"); ?></a>
         </div>
         <div class="card-content">
            <ul class="nav nav-pills nav-pills-warning">
               <li class="active"><a href="panels.html#pill1" data-toggle="tab"></a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="pill1">
                  <div class="col-md-12 col-sm-12">
                     <div class="table-responsive">
                        <table class="table">
                           <tbody>
                              <tr>
                                 <td colspan="4">
                                    <h6>Title </h6>
                                 </td>
                                 <td class="text-right"><?php echo e($review->title); ?></td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Full Name</h6>
                                 </td>
                                 <td class="text-right"> <?php echo e(optional($review->user)->fullname()); ?></td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Email </h6>
                                 </td>
                                 <td class="text-right"><?php echo e(optional($review->user)->email); ?></td>
                              </tr>
                              <tr>
                                 <td colspan="4">
                                    <h6>Phone </h6>
                                 </td>
                                 <td class="text-right"><?php echo e(optional($review->user)->phone_number); ?></td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Stars </h6>
                                 </td>
                                 <td class="text-right"><?php echo e($review->rating / 20); ?> stars</td>
                              </tr>

                              <tr>
                                 <td colspan="4">
                                    <h6>Description </h6>
                                 </td>
                                 <td class=""><?php echo e($review->description); ?> </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>




            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/reviews/show.blade.php ENDPATH**/ ?>