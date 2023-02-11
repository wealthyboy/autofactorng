<?php $__env->startSection('content'); ?>

<div class="row">
   <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <div class="col-sm-6 mt-sm-0 mt-4">
      <div class="card">
         <div class="card-body p-3 position-relative">
            <div class="row">
               <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold"><?php echo e($key); ?></p>
                  <h5 class="font-weight-bolder mb-0">
                     <?php echo e($stat); ?>

                  </h5>
               </div>
               <div class="col-5">
                  <div class="dropdown text-end">
                     <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-xs text-secondary">Today</span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers2">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7 days</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30 days</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<div class="row mt-4">
   <div class="col-12">
      <div class="card mb-4">
         <div class="card-header pb-0">
            <h6>Top Selling Products</h6>
         </div>
         <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
               <table class="table align-items-center mb-0">
                  <thead>
                     <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Value</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <div class="d-flex px-3 py-1">
                              <div>
                                 <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/blue-shoe.jpg" class="avatar me-3" alt="image">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm">Denso Horn </h6>
                                 <p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success">8.232</span> orders</p>
                              </div>
                           </div>
                        </td>
                        <td>
                           <p class="text-sm font-weight-normal mb-0">₦17,000</p>
                        </td>

                     </tr>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/index.blade.php ENDPATH**/ ?>