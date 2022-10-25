<?php $__currentLoopData = $obj->children->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="children" value="<?php echo e($obj->id); ?>">
       <div class="checkbox">
            <label>
                <input type="checkbox" value="<?php echo e($obj->id); ?>" name="selected[]" >
                <?php echo e($obj->name); ?>  <a href="<?php echo e(route($model.'.edit',[$url => $obj->id])); ?>"><i class="fa fa-pencil"></i> Edit</a>
            </label>
        </div>  
    <?php echo $__env->make('includes.children',['obj'=>$obj], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/includes/children.blade.php ENDPATH**/ ?>