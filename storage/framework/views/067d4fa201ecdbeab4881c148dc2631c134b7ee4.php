<?php $__env->startSection('content'); ?>
<div class="row">
   <?php echo $__env->make('admin.includes.top',['name' => 'Users','add' => true, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <div class="col-12">
      <div class="card">
         <div class="table-responsive">
         <form action="<?php echo e(route('admin.users.destroy',['user' => 1])); ?>" method="post" enctype="multipart/form-data" id="form-users">
          <?php echo csrf_field(); ?>
           <?php echo method_field('DELETE'); ?>
               <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                     <tr>
                        <th class="text-left">
                        </th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Date Added</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>
                           <div class="d-flex align-items-center">
                              <div class="form-check">
                                 <input class="form-check-input" name="selected[]" value="<?php echo e($user->id); ?>" type="checkbox" id="customCheck1">
                              </div>
                           </div>
                        </td>
                        <td class="font-weight-normal">
                           <span class="my-2 text-xs"><?php echo e($user->name); ?></span>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <div class="d-flex align-items-center">
                              <span><?php echo e($user->email); ?></span>
                           </div>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <span class="my-2 text-xs"><?php echo e($user->created_at->format('d/m/y')); ?></span>
                        </td>
                        <td class="text-xs font-weight-normal">
                           <a href="<?php echo e(route('admin.users.edit',['user'=> $user->id])); ?> " rel="tooltip" class="" data-original-title="" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                           </a>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                  </tbody>
               </table>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
searchable: true,
fixedHeight: false
});
document.querySelectorAll(".export").forEach(function(el) {
el.addEventListener("click", function(e) {
var type = el.dataset.type;
var data = {
type: type,
filename: "material-" + type,
};
if (type === "csv") {
data.columnDelimiter = "|";
}
dataTableSearch.export(data);
});
});
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/users/index.blade.php ENDPATH**/ ?>