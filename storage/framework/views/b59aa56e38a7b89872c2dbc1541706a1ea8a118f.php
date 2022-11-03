<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>
                </div>
                <h6 class="mb-0">Add Attributes</h6>
            </div>
            <div class="card-body pt-0">
                <form id="" action="<?php echo e(route('attributes.update',['attribute'=>$attr->id])); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label"> Name</label>
                                <input type="text" class="form-control" value="<?php echo e($attr->name); ?>" required="true" name="name">
                            </div>
                        </div>
                    </div>









                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label mt-4 ms-0"> </label>
                                <select class="form-control" name="parent_id" id="">
                                    <option value="">--Choose Parent--</option>
                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($attr->parent_id == $attribute->id): ?>
                                    <option value="<?php echo e($attribute->id); ?>" selected="selected"><?php echo e($attribute->name); ?> </option>
                                    <?php else: ?>
                                    <option class="" value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->name); ?> </option>
                                    <?php echo $__env->make('includes.product_attr',['attribute'=>$attribute], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label mt-4 ms-0"> </label>
                                <select class="form-control" name="type" id="">
                                    <option required value="">--Choose Type--</option>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option class="" value="<?php echo e($type); ?>" <?php echo e($attr->type == $type ? 'selected' : null); ?>><?php echo e($type); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>

                    </div>









                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="bor my-3">
                                <div class="form-check p-0">
                                    <label class="custom-control-label" for="w">
                                        <input onclick="$('input[name*=\'years\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name="">
                                        <span role="button" class="fw-bold">Years</span>
                                    </label>
                                </div>
                            </div>

                            <div class="well well-sm pb-5 border" style="height: 300px; background-color: #fff; color: black; overflow: auto;">
                                <?php $__currentLoopData = $helper->years(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="parent" value="">
                                    <div class="form-check ">
                                        <label class="custom-control-label" for="<?php echo e($year); ?>">
                                            <input class="form-check-input" value="<?php echo e($year); ?>" id="<?php echo e($year); ?>" <?php echo e(in_array($year, $years) ? 'checked' : ''); ?> type="checkbox" name="years[]">
                                            <span role="button" class="mt-4"><?php echo e($year); ?></span>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class=" my-3">
                                <div class="form-check p-0">
                                    <label class="custom-control-label" for="w-e">
                                        <input onclick="$('input[name*=\'engine\']').prop('checked', this.checked)" class="form-check-input" value="" id="w-e" type="checkbox" name="">
                                        <span role="button" class="fw-bold">Engine</span>
                                    </label>
                                </div>
                            </div>

                            <div class="well well-sm pb-5 border" style="height: 300px; background-color: #fff; color: black; overflow: auto;">
                                <?php $__currentLoopData = $engines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $engine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                <div class="d-flex mt-3">
                                    <div class="form-check">
                                        <label class="custom-control-label" for="<?php echo e($engine->id); ?>">
                                            <input class="form-check-input" value="<?php echo e($engine->id); ?>" id="<?php echo e($engine->id); ?>" <?php echo e($attr->engines->contains('id', $engine->id) ? 'checked' : ''); ?> type="checkbox" name="engine_id[]">
                                            <span role="button"><?php echo e($engine->name); ?></span>
                                        </label>
                                    </div>



                                    <div class="col-sm-3 ml-3 col-12">
                                        <?php $y = $attr->attr_engines->where('engine_id', $engine->id)->first(); ?>
                                        <div class="input-group input-group-dynamic">
                                            <label class="form-label "> </label>
                                            <select class="form-control mx-3 year Year_from-4runner" name="year_from[<?php echo e($engine->id); ?>][]" id="">
                                                <option value="">--Year from--</option>
                                                <?php $__currentLoopData = $helper->years(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(optional($y)->year_from == $year ? 'selected' : ''); ?> value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 ml-3 col-12">
                                        <div class="input-group input-group-dynamic">
                                            <label class="form-label "> </label>
                                            <select class="form-control year Year_to-4runner" name="year_to[<?php echo e($engine->id); ?>][]" id="">
                                                <option value="">--Year to--</option>
                                                <?php $__currentLoopData = $helper->years(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(optional($y)->year_to == $year ? 'selected' : ''); ?> value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>



                    </div>





                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/attributes/edit.blade.php ENDPATH**/ ?>