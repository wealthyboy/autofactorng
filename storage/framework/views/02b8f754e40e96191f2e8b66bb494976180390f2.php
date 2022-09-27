<form action="<?php echo e(route('products.index')); ?>" class="" method="get">
   <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-sm-3 col-5">
            <select class="form-control" name="category_id" id="parent_id">
                <option  value="">--Choose One--</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option class="" value="<?php echo e($category->id); ?>" ><?php echo e($category->name); ?> </option>
                    <?php echo $__env->make('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-sm-3 col-12">
            <div class="input-group input-group-outline">
                <label class="form-label">Product Name</label>
                <input name="product_name" type="text" class="form-control" placeholder="">
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="">
            <div class="row">
                <div class="col-sm-4 col-12">
                    <div class="input-group input-group-outline">
                    <label class="form-label mt-4 ms-0"> </label>
                    <select class="form-control" name="year_to" id="">
                        <option  value="">--Make--</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option class="" value="<?php echo e($year); ?>" ><?php echo e($year); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="input-group input-group-outline">
                    <label class="form-label mt-4 ms-0"> </label>
                    <select class="form-control" name="year_from" id="">
                        <option  value="">--Year to--</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option class="" value="<?php echo e($year); ?>" ><?php echo e($year); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="input-group input-group-outline">
                    <label class="form-label mt-4 ms-0"> </label>
                    <select class="form-control" name="year_to" id="">
                        <option  value="">--Year to--</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option class="" value="<?php echo e($year); ?>" ><?php echo e($year); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Rim</label>
                <input type="text" name="rim" class="form-control" placeholder="">
            </div>
        </div>

        

        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Height</label>
                <input type="text" name="height" class="form-control" placeholder="">
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Width</label>
                <input type="text" name="width" class="form-control" placeholder="">
            </div>
        </div>

        <div class="col-3">
            <div class="input-group input-group-outline">
                <label class="form-label">Amphere</label>
                <input type="text"  name="amphere" class="form-control" placeholder="">
            </div>
        </div>
    </div>

    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
</form><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/includes/product_search.blade.php ENDPATH**/ ?>