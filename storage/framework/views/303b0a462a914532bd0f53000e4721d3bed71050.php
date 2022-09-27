<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">All Promos</h5>
                    
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="<?php echo e(route('promos.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp;  Add Promo</a>
                            <a type="button" href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-promo').submit() : false;" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                                Delete
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <form action="<?php echo e(route('promos.destroy',['promo'=>1])); ?>" method="post" enctype="multipart/form-data" id="form-promo">
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

                            
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Backgorund</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </thead>
                        <tbody>
                            
                            <?php $__currentLoopData = $promos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td>
                                    <div class="form-check  p-3 pb-0">
                                        <input class="form-check-input" value="<?php echo e($promo->id); ?>" name="selected[]" type="checkbox" id="customCheck5">
                                    </div>
                                </td>
                                <td>
                                    <?php echo e($promo->bgcolor); ?>

                                    <ul>
                                        <?php $__currentLoopData = $promo->promo_texts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo_text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            <li>
                                                <?php echo e($promo_text->promo); ?>

                                                <span><a href="/admin/promo-text/edit/<?php echo e($promo_text->id); ?>"><i class="fa fa-pencil"></i> Edit</a></span>
                                                <span><a href="<?php echo e(route('delete.promo.text',['id'=>$promo_text->id])); ?>"><i class="fa fa-trash"></i> delete</a></span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul> 
                                </td>
                            
                                
                                <td class="text-sm">
                                    <a href="<?php echo e(route('create.promo.text',['id'=>$promo->id])); ?>" data-bs-toggle="tooltip" data-bs-original-title="Add text">
                                        +&nbsp; Add Text
                                    </a>
                                     |
                                    
                                    <a href="<?php echo e(route('promos.edit',['promo'=>$promo->id])); ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                    <i class="fa fa-pencil"></i> Edit
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









<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/promo/index.blade.php ENDPATH**/ ?>