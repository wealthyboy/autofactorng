<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Activities</h5>
                    
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <form action="<?php echo e(route('brands.destroy',['brand' => 1])); ?>" method="post" enctype="multipart/form-data" id="form-brand">
                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                               <th class="text-left">
                                 <div class="form-check p-0">
                                    <input class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                               </th>

                               <th class="text-left">Name</th>
                                <th class="">Activity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                    <tr>
                                        <td>
                                            <div class="form-check  p-3 pb-0">
                                                <input class="form-check-input" type="checkbox" id="customCheck5">
                                            </div>
                                        </td>
                                        
                                        <td class="text-center"><?php echo e(optional($activity->user)->name); ?></td>
                                         <td class="">
                                             <div  style="height: <?php echo e($activity->json ? '150px' : null); ?>; overflow-y: scroll;">
                                                
                                                <?php echo e(optional($activity->user)->name); ?> 
                                                <?php echo  html_entity_decode($activity->action) ?>  <br/>
                                                <?php if($activity->json): ?>
                                                    <?php $jsons =  json_decode($activity->json,true );  ?>
                                                    
                                                    <?php $__currentLoopData = $jsons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $json): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        Name:  <?php echo e($json['name']); ?> <br/> 
                                                        Price:  <?php echo e($json['price']); ?> <br/>
                                                        Qty:  <?php echo e($json['quantity']); ?> <br/>
                                                        Sale Price:  <?php echo e($json['sale_price']); ?> <br/>
                                                    <hr />
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            
                                            </div>
                                            
                                        
                                        </td>
                                        <td><?php echo e($activity->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        </tbody>
                        
                    </table>
                </form>
               </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('inline-scripts'); ?>
$(document).ready(function() {
});
<?php $__env->stopSection(); ?>














<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/activity/index.blade.php ENDPATH**/ ?>