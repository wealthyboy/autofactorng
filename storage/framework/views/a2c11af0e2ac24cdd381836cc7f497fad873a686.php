<?php $__env->startSection('content'); ?>

<div class="row">
   <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


   <div class="col-sm-3 mt-sm-0 mt-4">
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
                        <span class="text-xs text-secondary"><?php echo e($key == 'Customers' ? 'Total' : date("F", strtotime(date("Y") ."-". date('m') ."-01"))); ?></span>
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

<!-- Step 1: Create the containing elements. -->

<section id="auth-button"></section>
<section id="view-selector"></section>
<section id="timeline"></section>




<div class="row mb-4 row mt-4">
   <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card mb-4">
         <div class="card-header pb-0">
            <div class="row">
               <div class="col-lg-6 col-7">
                  <h6>Recent Orders</h6>

               </div>
               <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                     <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                     </a>
                     <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable" style="">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body px-0 pb-2">
            <div class="table-responsive">
               <table class="table align-items-center mb-0">
                  <thead>

                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $statistics['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <tr>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm"><?php echo e(null !== $order->user ? $order->user->fullname() : $order->fullName()); ?></h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm"><?php echo e(optional($order->orderEmail)->email ?? $order->email); ?></h6>
                              </div>
                           </div>
                        </td>
                        <td>
                           <div class="d-flex px-2 py-1">
                              <div>
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm"><?php echo e($order->created_at->format('d-m-y')); ?></h6>
                              </div>
                           </div>
                        </td>

                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                  </tbody>
               </table>
            </div>
         </div>
      </div>
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
                     <?php $__currentLoopData = $statistics['top_product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>
                           <div class="d-flex px-3 py-1">

                              <div class="d-flex flex-column justify-content-center">
                                 <h6 class="mb-0 text-sm"><?php echo e($top_product->product_name); ?> </h6>
                                 <p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success"><?php echo e($top_product->count); ?></span> orders</p>
                              </div>
                              <div>
                                 <?php echo e($top_product->qty); ?>

                              </div>
                           </div>
                        </td>
                        <td>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-4 col-md-6">
      <div class="card h-100">
         <div class="card-header pb-0">
            <h6>Activity</h6>
         </div>
         <div class="card-body p-3">
            <div class="timeline timeline-one-side">
               <?php $__currentLoopData = $statistics['activities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="timeline-block mb-3">
                  <span class="timeline-step">
                     <i class="material-symbols-outlined">
                        local_activity
                     </i>
                  </span>
                  <div class="timeline-content">
                     <h6 class="text-dark text-sm font-weight-bold mb-0"></h6>
                     <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo e(optional($activity->user)->name); ?> - <?php echo e($activity->action); ?></p>
                     <p class="text-info font-weight-bold text-xs mt-1 mb-0"><?php echo e($activity->created_at); ?></p>

                  </div>
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
         </div>
      </div>
   </div>
</div>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('inline-scripts'); ?>

gapi.analytics.ready(function() {

// Step 3: Authorize the user.

var CLIENT_ID = '<?php echo e(config('services.goggle.client_id')); ?>';

gapi.analytics.auth.authorize({
container: 'auth-button',
clientid: CLIENT_ID,
});

// Step 4: Create the view selector.

var viewSelector = new gapi.analytics.ViewSelector({
container: 'view-selector'
});

// Step 5: Create the timeline chart.

var timeline = new gapi.analytics.googleCharts.DataChart({
reportType: 'ga',
query: {
'dimensions': 'ga:date',
'metrics': 'ga:sessions',
'start-date': '30daysAgo',
'end-date': 'yesterday',
},
chart: {
type: 'LINE',
container: 'timeline'
}
});

// Step 6: Hook up the components to work together.

gapi.analytics.auth.on('success', function(response) {
viewSelector.execute();
});

viewSelector.on('change', function(ids) {
var newIds = {
query: {
ids: ids
}
}
timeline.set(newIds).execute();
});
});

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/index.blade.php ENDPATH**/ ?>