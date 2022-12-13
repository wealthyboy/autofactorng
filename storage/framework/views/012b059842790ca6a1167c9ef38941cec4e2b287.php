<?php if(!empty($models['items'][0][0])): ?>

<?php echo $__env->make('admin._partials.top',['name' => 'Users','add' => true, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin._partials.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="card">

    <div class="card-header">
        <h4 class="m-0"><?php echo e($name); ?></h4>
    </div>
    <div class="table-responsive mt-1">
        <form action="<?php echo e(route($models['routes']['destroy'][0], [ $models['routes']['destroy'][1] => 1 ])); ?>" method="post" enctype="multipart/form-data" id="form-table" class="is-filled">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <table class="table table-flush dataTable-table  align-items-center mb-0">
                <thead>
                    <tr>
                        <th data-sortable="" class="desc">
                            <div class="form-check p-0">
                                <input class="form-check-input" type="checkbox" id="customCheck5">
                            </div>
                        </th>
                        <?php $__currentLoopData = $models['items'][0][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th data-sortable="" class="desc">
                            <a href="#" class="dataTable-sorter">
                                <h6 class="mb-0 text-xs">
                                    <?php echo e($key); ?>

                                </h6>
                            </a>
                        </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $models['items'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" name="selected[]" value="<?php echo e($models['items'][0][$key]['Id']); ?>" type="checkbox" id="customCheck1">
                                </div>
                            </div>
                        </td>
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="">
                            <div class="align-middle  text-sm">
                                <?php if($k == 'Image'): ?>
                                <img src="<?php echo e($v); ?>" alt="" width="100" class="img-fluid" srcset="">
                                <?php else: ?>
                                <h6 class="mb-0 text-xs"><?php echo e($v); ?></h6>
                                <?php endif; ?>
                            </div>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(isset($models['unique']['show']) && $models['unique']['show']): ?>
                        <td>
                            <a href="<?php echo e($models['meta']['urls'][$key]['url']); ?>" data-bs-toggle="tooltip" data-bs-original-title="View">
                                <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                            </a>
                        </td>
                        <?php endif; ?>

                        <?php if(isset($models['unique']['edit']) && $models['unique']['edit']): ?>
                        <td class="text-xs font-weight-normal">
                            <a href="<?php echo e(route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => $models['items'][0][$key]['Id'] ])); ?>" rel="tooltip" class="" data-original-title="" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                        </td>
                        <?php endif; ?>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <?php if($models['meta']['sub_total']): ?>

            <table class="table ">
                <tfoot>
                    <?php $__currentLoopData = $summaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class=" text-right">
                        <td colspan="6" class="t"></td>
                        <td colspan="6" class="text-right "></td>

                        <td colspan="6" class="text-end">
                            <h6 class="mb-0 text-xs"><?php echo e($key); ?></h6>
                        </td>
                        <td colspan="" class="text-end"><?php echo e($summary); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tfoot>
            </table>
            <?php endif; ?>
        </form>

    </div>
    <div class="card-footer">
        <div class=" d-flex justify-content-between  mt-3">
            <p class="text-sm text-gray-700 leading-5">
                Showing <span><?php echo e($models['meta']['firstItem']); ?>- <?php echo e($models['meta']['lastItem']); ?> of <?php echo e($models['meta']['total']); ?> Records</span>
            </p>
            <?php echo e($models['meta']['links']); ?>

        </div>
    </div>
</div>


<?php else: ?>
<div class="card">
    <div class="row justify-content-center">
        <div class="col-6 col-sm-4 col-md-3 col-lg-12">
            <div href="#" class="icon-box nounderline text-center p-5">
                <i class=""></i>
                <h5 class="porto-sicon-title mx-2">No data yet</h5>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/_partials/t.blade.php ENDPATH**/ ?>