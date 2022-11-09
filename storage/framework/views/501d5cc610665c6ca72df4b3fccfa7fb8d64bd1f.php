<?php if($collections['items'][0]->count()): ?>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center mt-3">
            <div class="mb-0 align-self-center">
                <p class="text-sm text-gray-700 leading-5">
                    <?php echo __('Showing'); ?>

                    <?php if($pagination->firstItem()): ?>
                    <span class="font-medium"><?php echo e($pagination->firstItem()); ?></span>
                    <?php echo __('to'); ?>

                    <span class="font-medium"><?php echo e($pagination->lastItem()); ?></span>
                    <?php else: ?>
                    <?php echo e($pagination->count()); ?>

                    <?php endif; ?>
                    <?php echo __('of'); ?>

                    <span class="font-medium"><?php echo e($pagination->total()); ?></span>
                    <?php echo __('results'); ?>

                </p>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-1">
        <form action="#" method="post" enctype="multipart/form-data" id="form-auctions" class="is-filled">
            <input type="hidden" name="_token" value="PYlFxXUwxavupF6J09OR8TWqPrEQH8ciyislr1wH"> <input type="hidden" name="_method" value="DELETE">
            <table class="table table-flush dataTable-table  align-items-center mb-0">
                <thead>
                    <tr>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th data-sortable="" class="desc ">
                            <a href="#" class="dataTable-sorter">
                                <h6 class="mb-0 text-xs"><?php echo e(ucfirst(str_replace('_', ' ', $column))); ?></h6>
                            </a>
                        </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $collections['items'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <td class="">
                            <div class="align-middle  text-sm">
                                <h6 class="mb-0 text-xs"><?php echo e($collection[ $column ]); ?> </h6>
                            </div>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        <?php if(isset($collections['meta']['show']) && $collections['meta']['show'] ): ?>
                        <td class="align-middle">
                            <a href="#" class="text-primary font-weight-normal text-xs" rel="tooltip" data-original-title="" title="Edit">
                                <!-- <i class="material-symbols-outlined text-secondary font-weight-normal text-xs">edit</i>--> View
                            </a>
                        </td>
                        <?php endif; ?>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </form>

    </div>

    <div class="card-footer">
        <div class=" d-flex justify-content-end  mt-3">
            <div class="results ">
                <?php echo e($pagination->links()); ?>

            </div>

        </div>
    </div>



</div>

<?php else: ?>
<div class="card">
    <?php echo $__env->make('_partials.empty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/table.blade.php ENDPATH**/ ?>