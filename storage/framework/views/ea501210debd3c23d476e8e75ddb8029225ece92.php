<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('admin.includes.top',['add'=>true,'name' => 'Products', 'export' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card mb-3">

    <div class="card-header d-flex justify-content-between p-3 pt-2">
        <div>
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
              <i class="material-symbols-outlined">filter_alt</i>         

          </div>
        </div>

        <div>
          <a id="show-panel" href="#">Open/Close panel</a>
        </div>
        
      
    </div>

     <div id="search-panel" class="card-body pt-0 hide">
        <?php echo $__env->make('admin.includes.product_search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     </div>
</div>


  
        
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Products</h5>
            <div class="form-check">
                <label  class="custom-control-label" for="w">
                    <input  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" class="form-check-input" value="" id="w" type="checkbox" name=""  >
                    <span role="button">All</span> 
                </label>
            </div>
        </div>

        
    </div>

  <div class="table-responsive mt-1">
    <form action="<?php echo e(route('products.destroy',['product' => 1])); ?>" method="post" enctype="multipart/form-data" id="form-products">
      <?php echo csrf_field(); ?>
      <?php echo method_field('DELETE'); ?>
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text">
                  <div class="form-check p-0">
                      <input class="form-check-input"  onclick="$('input[name*=\'selected[]\']').prop('checked', this.checked)" type="checkbox" id="customCheck5">
                  </div>
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Image</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Product Name</th>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Category</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Price</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Status</th>
            <th class="text-secondary opacity-7"></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 

            <tr>
              <td>
                <div class="form-check  p-3 pb-0">
                    <input class="form-check-input" value="<?php echo e($product->id); ?>" name="selected[]" type="checkbox" id="customCheck5">
                </div>
              </td>
              <td>
                <div class="d-flex">
                    <figure class="avatar avatar-xl position-relative" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                      <a href="<?php echo e($product->image_to_show); ?>" itemprop="contentUrl" data-size="500x600">
                        <img class="border-radius-lg shadow" src="<?php echo e($product->image_to_show_m); ?>" alt="Image description">
                      </a>
                    </figure>
                </div>
              </td>

              <td>
                  <div class="d-flex  flex-column justify-content-center">
                    <h6 class="mb-0 text-xs"><?php echo e($product->name); ?> </h6>
                    <p class="text-xs text-secondary mb-0">0 orders</p>
                  </div>
              </td>

              
              <td>
                <p class="text-xs font-weight-bold mb-0"><?php echo e($product->category_name); ?></p>
              </td>
              <td class="align-middle text-center text-sm">
                ₦<?php echo e(number_format($product->price)); ?>

              </td>
              <td class="align-middle text-center">
                <span class="badge badge-sm badge-success">Online</span>
              </td>
              <td class="align-middle">
              
                <a href="<?php echo e(route('products.edit',['product'=> $product->id])); ?> " rel="tooltip" class="" data-original-title="" title="Edit">
                  <i class="material-symbols-outlined text-secondary font-weight-normal text-xs"">edit</i> Edit
                </a>
              </td>
            </tr>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
      </table>
    </form>

    <div class="mt-4 mb-4 d-flex justify-content-between">
        <?php echo $__env->make('admin.includes.paginator_showing', ['name' => $products], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>

var parent_id = document.getElementById('parent_id');
setTimeout(function () {
   const example = new Choices(parent_id);
}, 1);

$('#show-panel').on('click', function(e) {
    e.preventDefault();
    console.log(e)
    var element = document.getElementById("search-panel");
    element.classList.toggle('hide')
})


<?php $__env->stopSection(); ?>








<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/products/index.blade.php ENDPATH**/ ?>