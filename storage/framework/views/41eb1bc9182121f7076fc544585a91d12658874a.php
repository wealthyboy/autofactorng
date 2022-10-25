<?php $__currentLoopData = $obj->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if( isset($model) && $model->parent_id == $obj->id): ?>
        <option   
               <?php echo e(isset($disabled) ? 'disabled' : ''); ?>   
                value="<?php echo e($obj->id); ?>" 
                selected="selected">
                <?php echo e($obj->name); ?> 
        </option>
        <?php echo $__env->make('includes.children_options',['obj'=>$obj,'space'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <option   
            <?php echo e(isset($disabled) ?  'disabled' : ''); ?>  
            value="<?php echo e($obj->id); ?>"
        ><?php echo e(html_entity_decode($space)); ?><?php echo e($obj->name); ?> </option>
        <?php echo $__env->make('includes.children_options',['obj'=>$obj,'space'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/includes/children_options.blade.php ENDPATH**/ ?>