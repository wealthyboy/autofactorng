
    <div class="card">   
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">list</i>
                </div>
                <h6 class="mb-0"><?php echo e(ucfirst($title)); ?></h6>
            </div> 
            
            <div class="d-flex justify-content-between p-2">
                <div class="parent" value="">
                    <div class="form-check ">
                        <label  class="custom-control-label" for="delete">
                            <input  class="form-check-input" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" id="delete" name="optionsCheckboxes" >
                            <span role="button" class="mt-4">Select All</span> 
                        </label>
                    </div> 
                </div>

                <div  class="mr-3">
                    <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-<?php echo e($title); ?>').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                        <i class="material-icons"></i> Delete
                    </a>
                </div>
            </div>
            <div class="clearfix"></div> 
            <form action="<?php echo e(route($route.'.destroy',[$single_name=>1])); ?>" method="post" enctype="multipart/form-data" id="form-<?php echo e($title); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="material-datatables">
                    <div class="well well-sm pb-5" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
                    <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="parent" value="<?php echo e($collection->id); ?>">
                        <div class="form-check">
                            <label  class="custom-control-label" for="attr-<?php echo e($collection->id); ?>">
                                <input class="form-check-input " value="<?php echo e($collection->id); ?>" type="checkbox" id="attr-<?php echo e($collection->id); ?>" name="selected[]" >
                                <span role="button"><?php echo e($collection->name == "" ? $collection->title :  $collection->name == ""); ?></span> 
                                <a href="<?php echo e(route($route.'.edit',[$single_name =>$collection->id])); ?>">
                                <i class="fa fa-pencil"></i> Edit</a>
                            </label>
                        </div> 
                        <?php echo $__env->make('includes.children',['obj'=>$collection,'space'=>'&nbsp;&nbsp;','model' => $title,'url' => $single_name, 'year' => $year, 'name' => $name, 'route' => $route ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </div>
                </div>
            </form>
        </div><!--  end card  -->
    </div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/_partials/children.blade.php ENDPATH**/ ?>