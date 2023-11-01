<form action="<?php echo e(route('products.index')); ?>" class="filter-form" method="get">
    <?php echo csrf_field(); ?>
    <div class="row">

        <div class="col-sm-6 col-12">
            <div class="input-group input-group-outline">
                <label class="form-label">Product Name</label>
                <input name="product_name" type="text" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-sm-6 col-5">
            <select name="category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                <option selected value=""> Select Category</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="" value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?> </option>
                <?php echo $__env->make('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

    </div>
    <div class="row mt-3">
        <div class="">
            <div class="row">
                <div class="col-sm-3 col-12">
                    <select name="year" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Year</option>
                        <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="" value="<?php echo e($year); ?>"><?php echo e($year); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select id="make_id" name="make_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Make</option>
                        <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="" value="<?php echo e($make->id); ?>"><?php echo e($make->name); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-3 col-12">
                    <select name="model_id" id="model_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Model</option>

                    </select>
                </div>

                <div class="col-sm-3 col-12">
                    <select name="engine_id" id="engine_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                        <option selected value=""> Select Engine</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <input name="search" type="hidden" value="1" />
    <div class="row mt-4 mb-3">
        <div class="col-3">

            <select name="rim" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Rim</option>
                <?php $__currentLoopData = $rims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="" value="<?php echo e($rim->radius); ?>"><?php echo e($rim->radius); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>



        <div class="col-3">

            <select name="width" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Width</option>
                <?php $__currentLoopData = $widths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $width): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="" value="<?php echo e($width->width); ?>"><?php echo e($width->width); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-3">

            <select name="height" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Height</option>
                <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="" value="<?php echo e($profile->height); ?>"><?php echo e($profile->height); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>

        <div class="col-3">
            <select name="amphere" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg">
                <option selected value=""> Select Amphere</option>
                <?php $__currentLoopData = $ampheres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amphere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="" value="<?php echo e($amphere->amphere); ?>"><?php echo e($amphere->amphere); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
    </div>

    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
</form><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/includes/product_search.blade.php ENDPATH**/ ?>