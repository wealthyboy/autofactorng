<?php if(optional($obj)->children): ?>
<?php $__currentLoopData = $obj->children->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="children" value="<?php echo e($ob->id); ?>">
    <div class="d-flex">
        <div class="form-check">
            <label class="custom-control-label" for="<?php echo e($ob->slug); ?>-<?php echo e($ob->id); ?>">
                <input class="form-check-input car-models <?php echo e($url); ?> <?php echo e($obj->slug); ?> <?php echo e($obj->name == 'Spare Parts' || $obj->name == 'Servicing Parts'  ? 'no-validation' : ''); ?>" value="<?php echo e($ob->id); ?>" data-slug="<?php echo e($ob->slug); ?>" data-name="<?php echo e($ob->name); ?>" type="checkbox" id="<?php echo e($ob->slug); ?>-<?php echo e($ob->id); ?>" name="<?php echo e($name); ?>[]">
                <span role="button"><?php echo e($ob->name); ?></span>
                <a href="<?php echo e(route($route.'.edit',[$url => $ob->id])); ?>">
                    <i class="fa fa-pencil"></i>
                    Edit
                </a>

                <?php if(isset($link)): ?>
                |
                <a href="<?php echo e(config('app.url')); ?>/products/<?php echo e($ob->slug); ?>">
                    <i class="fa fa-external-link" aria-hidden="true"></i>Link
                </a>
                <?php endif; ?>


            </label>
        </div>


        <?php if(isset($year) && $year): ?>

        <?php if(null !== $ob->attribute_years): ?>
        <div class="col-sm-3 ml-3 col-12">
            <div class="input-group input-group-dynamic">
                <label class="form-label "> </label>
                <select class="form-control mx-3 year Year_from-<?php echo e($ob->slug); ?>" name="year_from[<?php echo e($ob->id); ?>]" id="">
                    <option value="">--Year from--</option>
                    <?php $__currentLoopData = $ob->attribute_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($attribute_year->year); ?>"><?php echo e($attribute_year->year); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 ml-3 col-12">
            <div class="input-group input-group-dynamic">
                <label class="form-label "> </label>
                <select class="form-control year Year_to-<?php echo e($ob->slug); ?>" name="year_to[<?php echo e($ob->id); ?>]" id="">
                    <option value="">--Year to--</option>
                    <?php $__currentLoopData = $ob->attribute_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option class="" value="<?php echo e($attribute_year->year); ?>"><?php echo e($attribute_year->year); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>


    </div>

    <?php if(isset($engine) && $engine && null !== $ob->engines): ?>
    <?php $__currentLoopData = $ob->engines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $engine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="children" value="<?php echo e($engine->id); ?>">
        <div class="d-flex">
            <div class="form-check">
                <label class="custom-control-label " for="<?php echo e($ob->slug); ?>-<?php echo e($engine->id); ?>">
                    <input class="form-check-input  engine-<?php echo e($ob->slug); ?>" value="<?php echo e($engine->id); ?>" type="checkbox" id="<?php echo e($ob->slug); ?>-<?php echo e($engine->id); ?>" name="engine_id[<?php echo e($ob->id); ?>][]" data-slug="<?php echo e($ob->slug); ?>" data-name="<?php echo e($ob->name); ?>">
                    <span role="button"><?php echo e($engine->name); ?></span>
                </label>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php echo $__env->make('includes.children',['obj'=>$ob], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/includes/children.blade.php ENDPATH**/ ?>