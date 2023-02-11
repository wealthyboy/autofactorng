<?php if(count($errors) > 0): ?>
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="padding-left: 5px;"> &nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i>         
               <span class="text-sm text-white"> <?php echo e($error); ?>  </span>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
        </button>
     </div>
 
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/errors/errors.blade.php ENDPATH**/ ?>