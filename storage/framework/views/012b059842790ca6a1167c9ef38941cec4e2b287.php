<?php if(!empty($models['items'][0])): ?>
<div class="card">

    <div class="card-header">
        <h4 class="m-0"><?php echo e($name); ?></h4>
    </div>
    <div class="table-responsive mt-1">
        <form action="#" method="post" enctype="multipart/form-data" id="form-auctions" class="is-filled"><input type="hidden" name="_token" value="PYlFxXUwxavupF6J09OR8TWqPrEQH8ciyislr1wH"> <input type="hidden" name="_method" value="DELETE">
            <table class="table table-flush dataTable-table  align-items-center mb-0">
                <thead>
                    <tr>
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
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="">
                            <div class="align-middle  text-sm">
                                <?php if($k == 'Image'): ?>
                                <img src="<?php echo e($v); ?>" alt="" width="100" class="img-fluid" srcset="">
                                <?php else: ?>
                                <h6 class="mb-0 text-xs"><?php echo e($v); ?>

                                </h6>
                                <?php endif; ?>

                            </div>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($models['meta']['show']): ?>
                        <td>
                            <a href="<?php echo e($models['meta']['urls'][$key]['url']); ?>" data-bs-toggle="tooltip" data-bs-original-title="View">
                                <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <?php if($models['meta']['sub_total']): ?>
            <div class="">
                <div class="border d-flex justify-content-between text-right  ">
                    <span colspan="6" class="flex-grow-1 border">Sub-Total</span>
                    <span colspan="" class="text-right"><?php echo e('number_format($sub_total)'); ?></span>
                </div>
            </div>
            <table class="table ">
                <tfoot>
                    <tr class="border text-right">
                        <td colspan="6" class="text-right border"></td>
                        <td colspan="6" class="text-right border"></td>

                        <td colspan="19" class="text-right border">Sub-Total</td>
                        <td colspan="" class="text-right"><small>ee</small><?php echo e('number_format($sub_total)'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Coupon</td>
                        <td class="text-right"> ff</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Shipping</td>
                        <td class="text-right"><small></small><?php echo e('optional($order->shipping)->price'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td class="text-right"><?php echo e('$order->get_total()'); ?></td>
                    </tr>
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
                <h5 class="porto-sicon-title mx-2">No transaction yet</h5>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/_partials/t.blade.php ENDPATH**/ ?>