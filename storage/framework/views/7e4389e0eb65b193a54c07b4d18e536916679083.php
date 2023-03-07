<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">filter_alt</i>
            </div>
            <h6 class="mb-0">Edit <?php echo e($information->title); ?></h6>
         </div>
         <div class="card-body pt-0">
            <form action="<?php echo e(route('pages.update',['page' => $information->id])); ?>" method="post" enctype="multipart/form-data" id="form-category">
               <?php echo csrf_field(); ?>
               <?php echo method_field('PATCH'); ?>
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="name"
                           value="<?php echo e($information->name); ?>"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Sort order</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="sort_order"
                           value="<?php echo e($information->sort_order); ?>"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Custom  Link</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="link"
                           value="<?php echo e($information->link); ?>"

                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control"                                     
                           name="meta_title"
                           value="<?php echo e($information->meta_title); ?>"
                           >
                     </div>
                  </div>
               </div>
              
               <div class="row mt-3">
                    <div class="col-sm-12 col-12">
                        <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="parent_id" id="">
                        <option  value="">--Choose Parent--</option>
                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($information->parent_id == $page->id): ?>
                                <option class="" value="<?php echo e($page->id); ?>" selected="selected"><?php echo e($page->name); ?> </option>
                            <?php else: ?>
                                <option class="" value="<?php echo e($page->id); ?>"><?php echo e($page->name); ?>  </option>
                                <?php echo $__env->make('includes.product_attr',['attribute'=>$page], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                              <option  value="">--Same Page--</option>
                              <option <?php echo e($information->same_page ? 'selected' : ''); ?> value="yes">Yes </option>
                              <option <?php echo e(!$information->same_page ? 'selected' : ''); ?> value="no" >No</option>

                           </select>
                     </div>
                  </div>
                </div>

               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Description</label>
                        <div class="form-group ">
                           <label class="control-label"> </label>
                           <textarea name="description" 
                           id="description" class="form-control" required rows="20"><?php echo e($information->description); ?></textarea>
                        </div>
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
<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('ckeditor/ckeditor.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>
CKEDITOR.replace('description',{
        height: '400px'
    })

var parent_id = document.getElementById('parent_id');
   setTimeout(function () {
   const example = new Choices(parent_id);
}, 1);

<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/information/edit.blade.php ENDPATH**/ ?>