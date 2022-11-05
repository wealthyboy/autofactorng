<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Engines</h5>
                    
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="<?php echo e(route('engines.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New Engine</a>
                            <a type="button" href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-engine').submit() : false;" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                                Delete
                            </a>
                            
                            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <form action="<?php echo e(route('engines.destroy',['engine' => 1])); ?>" method="post" enctype="multipart/form-data" id="form-engine">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <table class="table table-flush" id="brand-list">
                        <thead class="thead-light">
                            <tr>
                            <th class="text-left">
                               <div class="form-check p-0">
                                    <input class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                            </th>

                            <th>
                                Engine
                            </th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $__currentLoopData = $engines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $engine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td>
                                    <div class="form-check  p-3 pb-0">
                                        <input class="form-check-input" value="<?php echo e($engine->id); ?>" name="selected[]" type="checkbox" id="customCheck5">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <h6 class="ms-3 my-auto"> <?php echo e($engine->name); ?></h6>
                                    </div>
                                </td>
                            
                                <td class="text-sm">
                                    <a href="<?php echo e(route('engines.edit',['engine' => $engine->id ])); ?>">
                                       <span class="ms-3 my-auto"> Edit</span>
                                    </a>
                                </td>
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






<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/engines/index.blade.php ENDPATH**/ ?>