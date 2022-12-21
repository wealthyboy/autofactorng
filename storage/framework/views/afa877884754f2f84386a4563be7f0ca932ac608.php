<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="table-responsive">
            <table class="table table-flush dataTable-table  align-items-center mb-0">
               <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-left">
                        </th>

                        <th data-sortable="" class="<?php echo e('desc'); ?>">
                           <a href="#" class="dataTable-sorter">
                              <h6 class="mb-0 text-xs">
                                 Store Name
                              </h6>
                           </a>
                        </th>
                        <th data-sortable="" class="<?php echo e('desc'); ?>">
                           <a href="#" class="dataTable-sorter">
                              <h6 class="mb-0 text-xs">
                                 Store Url
                              </h6>
                           </a>
                        </th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>
                           <div class="d-flex align-items-center">
                              <div class="form-check">
                                 <input class="form-check-input" name="years[]" value="<?php echo e('id'); ?>" type="checkbox" id="customCheck1">
                              </div>
                           </div>
                        </td>



                        <td class="">


                           <div class="align-middle  text-sm">
                              <h6 class="mb-0 text-xs"><?php echo e(Config('app.name')); ?></h6>
                           </div>

                        </td>
                        <td class="">


                           <div class="align-middle  text-sm">
                              <h6 class="mb-0 text-xs"><?php echo e(Config('app.url')); ?></h6>
                           </div>

                        </td>
                        <td class="text-xs font-weight-normal">
                           <a href="<?php echo e(route('settings.edit',['setting'=>1])); ?>" rel="tooltip" class="mx-3" data-original-title="" title="Edit">
                              <span class="material-symbols-outlined  text-secondary position-relative text-lg">edit</span>
                           </a>
                        </td>
                     </tr>

                  </tbody>
               </table>
               </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>