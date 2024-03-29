<?php echo $__env->make('admin._partials.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if( isset($models['unique']['product']) && $models['unique']['product']): ?>
<div class="row">
    <div class="card mb-3">

        <div class="card-header d-flex justify-content-between p-3 pt-2">
            <div>
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>

                </div>
            </div>

            <div class="align-self-center">
                <a id="show-panel" href="#">Open/Close panel</a>
            </div>


        </div>

        <div id="search-panel" class="card-body pt-0 ">
            <?php echo $__env->make('admin.includes.product_search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <?php endif; ?>

    <?php if(!empty($models['items'][0][0])): ?>

    <?php echo $__env->make('admin._partials.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <div class="<?php echo e(isset($no_card) ? '' : 'card'); ?>">
        <div class="card-header ps-2">
            <h4 class="m-0"><?php echo e($name); ?></h4>
        </div>
        <div class="table-responsive mt-1">
            <form action="<?php echo e(route($models['routes']['destroy'][0], [ $models['routes']['destroy'][1] => 1 ])); ?>" method="post" enctype="multipart/form-data" id="form-table" class="is-filled">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <table class="table table-flush dataTable-table  align-items-center mb-0">
                    <thead>
                        <tr class="table-heading">
                            <?php if( isset($models['meta']['show_checkbox']) && $models['meta']['show_checkbox']): ?>

                            <th data-sortable="" class="">
                                <div class="form-check ">
                                    <input onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" type="checkbox" id="customCheck5">
                                </div>
                            </th>
                            <?php endif; ?>
                            <?php $__currentLoopData = $models['items'][0][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th data-sortable="" class="<?php echo e(isset($models['meta']['sort']) ?  $models['meta']['sort'] : 'desc'); ?> ">
                                <a href="<?php echo e(request()->url()); ?>?key=<?php echo e($key); ?>&sort=<?php echo e($models['meta']['sort']); ?><?php echo e($models['meta']['q']); ?>" class="<?php echo e(isset($no_card) ? '' : 'dataTable-sorter'); ?>">
                                    <h6 class="mb-0 text-xs">
                                        <?php echo e($key); ?>

                                    </h6>
                                </a>
                            </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $models['items'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="table-body">
                            <?php if( isset($models['meta']['show_checkbox']) && $models['meta']['show_checkbox']): ?>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" name="selected[]" value="<?php echo e(isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null); ?>" type="checkbox" id="customCheck1">
                                    </div>
                                </div>
                            </td>
                            <?php endif; ?>
                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="">
                                <?php if($k == 'Image'): ?>

                                <div class="d-flex">
                                    <figure class="avatar avatar-xl position-relative" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                                        <a href="<?php echo e($v); ?>" itemprop="contentUrl" data-size="500x600">
                                            <img class="border-radius-lg shadow" src="<?php echo e($v); ?>" alt="Image description">
                                        </a>
                                    </figure>
                                </div>
                                <?php else: ?>

                                <div class="align-middle  text-sm">

                                    <?php if(is_array($v)): ?>
                                    <select name="" style="width: 100px;" class="form-control  change-status border px-1 text-xs" data-column="<?php echo e($k); ?>" data-id="<?php echo e(isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null); ?>" data-model="Order" name="[]">
                                        <?php $__currentLoopData = $v; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l => $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($l == 'selected'): ?>
                                        <option value="<?php echo e($lv); ?>" selected><?php echo e($lv); ?></option>
                                        <?php else: ?>

                                        <option value="<?php echo e($lv); ?>"><?php echo e($lv); ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php else: ?>
                                    <h6 data-price="<?php echo e($k == 'Price' ? $v  : ''); ?>" data-id="<?php echo e(isset( $models['items'][0][$key]['Id']) ?   $models['items'][0][$key]['Id'] : null); ?>" class=" <?php echo  $k == 'Price' ?  'update_price' : '' ?> mb-0 text-xs" <?php echo e($k == 'Price' ? 'contenteditable' : null); ?>><?php echo e($v); ?></h6>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(isset($models['unique']['show']) && $models['unique']['show']): ?>
                            <td>
                                <a href="<?php echo e($models['meta']['urls'][$key]['url']); ?>" data-bs-toggle="tooltip" data-bs-original-title="View">
                                    <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                                </a>
                            </td>
                            <?php endif; ?>

                            <?php if(isset($models['unique']['order']) && $models['unique']['order']): ?>

                            <td class="text-xs font-weight-normal">
                                <a target="_blank" href="/admin/orders/invoice/<?php echo e(isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null); ?>" rel="tooltip" data-bs-toggle="tooltip" data-bs-original-title="Invoice">
                                    <i class="material-symbols-outlined text-secondary position-relative text-lg">receipt</i>
                                </a>
                            </td>

                            <td class="text-xs font-weight-normal">
                                <a href="<?php echo e(route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null  ])); ?>" rel="tooltip" class="" data-original-title="" title="Edit">
                                    <span class="material-symbols-outlined text-secondary position-relative text-lg">redo</span>
                                </a>
                            </td>

                            <?php endif; ?>

                            <?php if(isset($models['unique']['edit']) && $models['unique']['edit']): ?>
                            <td class="text-xs font-weight-normal">
                                <a href="<?php echo e(route($models['routes']['edit'][0], [ $models['routes']['edit'][1] => isset($models['items'][0][$key]['Id']) ?  $models['items'][0][$key]['Id'] : null  ])); ?>" rel="tooltip" class="" data-original-title="" title="Edit">
                                    <span class="material-symbols-outlined  text-secondary position-relative text-lg">edit</span> Edit
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
        <?php if(!isset($no_card)): ?>
        <div class="card-footer">
            <div class=" d-flex justify-content-between  mt-3">
                <p class="text-sm text-gray-700 leading-5">
                    Showing <span><?php echo e($models['meta']['firstItem']); ?>- <?php echo e($models['meta']['lastItem']); ?> of <?php echo e($models['meta']['total']); ?> Records</span>
                </p>
                <?php echo e($models['meta']['links']); ?>

            </div>
        </div>

        <?php endif; ?>
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