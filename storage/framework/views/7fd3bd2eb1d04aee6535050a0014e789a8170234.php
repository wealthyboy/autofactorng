<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('products.update',['product'=>$product->id])); ?>" class="" method="post" data-method="POST" enctype="multipart/form-data" id="form-product">
   <?php echo method_field('PATCH'); ?>
   <?php echo csrf_field(); ?>

   <div class="row">
      <div class="col-md-7">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">filter_alt</i>
               </div>
               <h6 class="mb-0">Edit Product</h6>
            </div>
            <div class="card-body pt-0">

               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="<?php echo e(isset($product) ? $product->product_name : old('product_name')); ?>">
                     </div>
                  </div>
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="brand_id" id="">
                           <option value="">--Brand--</option>
                           <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if( $product->brand_id == $brand->id): ?>
                           <option value="<?php echo e($brand->id); ?>" selected> <?php echo e($brand->name); ?> </option>
                           <?php else: ?>
                           <option value="<?php echo e($brand->id); ?>"> <?php echo e($brand->name); ?> </option>
                           <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Price</label>
                        <input type="number" class="form-control" name="price" required value="<?php echo e(isset($product) ? $product->price : old('price')); ?>">
                     </div>
                  </div>

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sale Price</label>
                        <input type="number" class="form-control" name="sale_price" value="<?php echo e(isset($product) ? $product->sale_price : old('sale_price')); ?>">
                     </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sales Start Date</label>
                        <input name="sale_price_starts" value="<?php echo e($product->sale_price_starts); ?>" class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sales End Date</label>
                        <input name="sale_price_ends" value="<?php echo e($product->sale_price_ends); ?>" class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Voltage</label>
                        <input type="text" class="form-control" name="volts" id="voltage" value="12" readonly>
                     </div>
                     <div></div>
                  </div>
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="amphere" id="">
                           <option value="">--Battery Amphere--</option>
                           <?php $__currentLoopData = $amps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option <?php echo e($product->amphere == $amp ? 'selected' : ''); ?> class="" value="<?php echo e($amp); ?>"><?php echo e($amp); ?> </option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Radius</label>
                        <input type="number" class="form-control" name="radius" value="<?php echo e(isset($product) ? $product->radius : old('product_radius')); ?>">
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Width</label>
                        <input type="number" class="form-control" name="width" value="<?php echo e(isset($product) ? $product->width : old('width')); ?>">
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Height</label>
                        <input type="number" class="form-control" name="height" value="<?php echo e(isset($product) ? $product->height : old('height')); ?>">
                     </div>
                  </div>
               </div>


               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo e(isset($product) ? $product->title : old('meta_title')); ?>">
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Keywords</label>
                        <input type="text" class="form-control" name="keywords" value="<?php echo e(isset($product) ? $product->keywords : old('keywords')); ?>">

                        <input type="hidden" class="images" name="images">

                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Meta Description</label>
                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control" name="meta_description" rows="8"><?php echo e(isset($product) ? $product->meta_description : old('meta_description')); ?></textarea>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Description</label>

                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control" name="description" rows="8"><?php echo e(isset($product) ? $product->description : old('description')); ?></textarea>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Physical Description</label>
                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control" name="phy_desccfff" rows="8" id="phy_description">
                        <?php echo e($product->phy_desc); ?>

                        </textarea>
                     </div>
                  </div>
               </div>


               <div class="col-12 my-3">
                  <div id="j-drop" class="j-activate j-drop">
                     <input accept="image/*" onchange="getFile(this,'images[]','Image')" class="upload_input" data-msg="Upload  your image" type="file" name="img" />
                     <div class=" upload-text <?php echo e($product->images->count() ||  $product->image ? 'hide' : ''); ?>">
                        <a class="j-activate" href="#">
                           <img class="" src="/images/utils/upload_icon.png">
                           <b>Click on anywhere to upload image</b>
                        </a>
                     </div>
                     <div id="j-details" class="j-details">
                        <?php if($product->images->count()): ?>
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="<?php echo e($image->id); ?>" class="j-complete">
                           <div class="j-preview">
                              <img class="img-thumnail" src="<?php echo e($image->image); ?>">
                              <div id="remove_image" class="remove_image remove-image">
                                 <a class="remove-image" data-id="<?php echo e($image->id); ?>" data-randid="<?php echo e($image->id); ?>" data-model="Image" data-type="complete" data-url="<?php echo e($image->image); ?>" href="#">Remove</a>
                              </div>

                           </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

               <?php echo $__env->make('admin._partials.is_featured', ['model' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


               <hr class="horizontal dark">


               <div class="form-check form-switch">
                  <input class="form-check-input" name="condition_is_present" value="1" <?php echo e($product->condition_is_present ? 'checked' : ''); ?> type="checkbox" id="heavy_item">
                  <label class="form-check-label" for="heavy_item">Heavy/Large Item</label>
               </div>



               <?php $__currentLoopData = $product->heavy_item_lagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $heavy_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div id="row-<?php echo e($heavy_item->id); ?>" class="row large-items dup-lagos my-3 ">
                  <h6 class="my-3"> Lagos</h6>

                  <div class="col-sm-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[lagos][tag][]" id="" class="form-control">
                           <option value="quantity">Quantity</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[lagos][condition][]" id="" class="form-control">
                           <option <?php echo e($heavy_item->condition == '>' ? 'selected' : null); ?> value=">">greater than</option>
                           <option <?php echo e($heavy_item->condition == '=' ? 'selected' : null); ?> value="=">Equal to</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[lagos][tag_value][]" id="" class="form-control">
                           <option <?php echo e($heavy_item->tag_value == '1' ? 'selected' : null); ?> value="1">1</option>
                           <option <?php echo e($heavy_item->tag_value == '2' ? 'selected' : null); ?> value="2">2</option>
                           <option <?php echo e($heavy_item->tag_value == '3' ? 'selected' : null); ?> value="3">3</option>
                           <option <?php echo e($heavy_item->tag_value == '4' ? 'selected' : null); ?> value="4">4</option>
                           <option <?php echo e($heavy_item->tag_value == '5' ? 'selected' : null); ?> value="5">5</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"></label>
                        <input type="text" class="form-control" value="<?php echo e($heavy_item->price); ?>" placeholder="Price" name="condition[lagos][price][]">
                     </div>
                  </div>
                  <?php if($key != 0): ?>
                  <div class="col-sm-1"><button data-id="<?php echo e($heavy_item->id); ?>" onclick="$('#row-<?php echo e($heavy_item->id); ?>').remove();" class="remove-section-lagos btn btn-outline-primary btn-sm mb-0" type="button"><i class="fa fa-trash" aria-hidden="true"></i> </button></div>
                  <?php endif; ?>
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               <div class="row large-items  d-none dup-lagos"></div>

               <div class="row button-lagos large-items my-3  <?php echo e($product->condition_is_present ? '' : 'd-none'); ?>">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addRowLagos();" id="add-more-lagos" type="button" class="btn btn-outline-primary btn-sm mb-0">+Add more</button>
                  </div>
               </div>

               <?php $__currentLoopData = $product->heavy_item_outside_lagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $heavy_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

               <div id="out_row-<?php echo e($heavy_item->id); ?>" class="row large-items dup-out-lagos my-3 ">
                  <h6 class="my-3">Outside Lagos</h6>

                  <div class="col-sm-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][tag][]" id="" class="form-control">
                           <option value="quantity">Quantity <?php echo e($heavy_item->quantity); ?></option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][condition][]" id="" class="form-control">
                           <option <?php echo e($heavy_item->condition == '>' ? 'selected' : null); ?> value=">">greater than</option>
                           <option <?php echo e($heavy_item->condition == '=' ? 'selected' : null); ?> value="=">Equal to</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][tag_value][]" id="" class="form-control">
                           <option <?php echo e($heavy_item->tag_value == '1' ? 'selected' : null); ?> value="1">1</option>
                           <option <?php echo e($heavy_item->tag_value == '2' ? 'selected' : null); ?> value="2">2</option>
                           <option <?php echo e($heavy_item->tag_value == '3' ? 'selected' : null); ?> value="3">3</option>
                           <option <?php echo e($heavy_item->tag_value == '4' ? 'selected' : null); ?> value="4">4</option>
                           <option <?php echo e($heavy_item->tag_value == '5' ? 'selected' : null); ?> value="5">5</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"></label>
                        <input type="text" class="form-control" value="<?php echo e($heavy_item->price); ?>" placeholder="Price" name="condition[out_side_lagos][price][]">
                     </div>
                  </div>
                  <?php if($key != 0): ?>
                  <div class="col-sm-1">
                     <button data-id="<?php echo e($heavy_item->id); ?>" onclick="$('#out_row-<?php echo e($heavy_item->id); ?>').remove();" class="remove-section-lagos btn btn-outline-primary btn-sm mb-0" type="button"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               <div class="row large-items  d-none dup-out-lagos"></div>


               <div class="row button-lagos large-items my-3   <?php echo e($product->condition_is_present ? '' : 'd-none'); ?>">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addRowOutSideLagos();" id="add-more-out-sidelagos" type="button" class="btn btn-outline-primary btn-sm mb-0">+Add more</button>
                  </div>
               </div>

               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" id="submit-product-form-button" class="btn bg-gradient-dark m-0 ms-2">
                     <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                     <span id="submit-product-form-text">Submit</span>
                  </button>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-5">
         <!--  end card  -->
         <div class="card mt-4">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">list</i>
               </div>
               <h6 class="mb-0">Attributes</h6>
            </div>
            <div class="material-datatables">
               <div class="well well-sm pb-5" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                  <div class="attribute fw-bold  text-sm text-danger px-4 "></div>

                  <div class="accordion-1">
                     <div class="container">

                        <div class="row">
                           <div class="">
                              <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="accordion" id="accordionRental">
                                 <div class="accordion-item mb-3">
                                    <h5 class="accordion-header" id="headingOne<?php echo e($attribute->id); ?>">
                                       <button class="accordion-button border-bottom font-weight-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo e($attribute->id); ?>" aria-expanded="false" aria-controls="collapseOne">
                                          <div class=" form-check px-0 ">
                                             <label class="custom-control-label" for="<?php echo e($attribute->name); ?>-<?php echo e($attribute->id); ?>">
                                                <input <?php echo e($helper->check($product->attributes, $attribute->id)); ?> data-name="<?php echo e($attribute->name); ?>" data-slug="<?php echo e($attribute->slug); ?>" class="form-check-input parent-attr" value="<?php echo e($attribute->id); ?>" type="checkbox" id="<?php echo e($attribute->name); ?>-<?php echo e($attribute->id); ?>" name="attribute_id[]">
                                                <span role="button"><?php echo e($attribute->name); ?></span>
                                                <a href="<?php echo e(route('attributes.edit',['attribute'=>$attribute->id])); ?>">
                                                   <i class="fa fa-pencil"></i> Edit</a>
                                             </label>
                                          </div>
                                          <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                                          <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                                       </button>
                                    </h5>
                                    <div id="collapseOne<?php echo e($attribute->id); ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo e($attribute->id); ?>" data-bs-parent="#accordionRental" style="">
                                       <div class="accordion-body text-sm opacity-8">
                                          <div class="parent" value="<?php echo e($attribute->id); ?>">

                                             <?php echo $__env->make('includes.edit_children',[ 'collections' => $product->attributes, 'obj'=>$attribute,'space'=>'&nbsp;&nbsp;','model' => 'attributes','url' => 'attribute','year' => true, 'name' => 'attribute_id', 'route' => 'attributes'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           </div>
                        </div>
                     </div>
                  </div>

               </div>


            </div>
         </div>


         <div class="card mt-4">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">list</i>
               </div>
               <h6 class="mb-0">Categories</h6>
            </div>
            <div class="material-datatables">
               <div class="categories fw-bold  text-sm text-danger px-4 "></div>

               <div class="well well-sm pb-5" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="parent" value="<?php echo e($category->id); ?>">

                     <div class="form-check ">

                        <label class="custom-control-label" for="<?php echo e($category->name); ?>-<?php echo e($category->id); ?>">
                           <input class="form-check-input <?php echo e($category->name == 'Spare Parts' || $category->name == 'Servicing Parts'  ? 'no-validation' : ''); ?>" <?php echo e($helper->check($product->categories, $category->id)); ?> value="<?php echo e($category->id); ?>" type="checkbox" id="<?php echo e($category->name); ?>-<?php echo e($category->id); ?>" name="category_id[]">
                           <span role="button"><?php echo e($category->name); ?></span>
                           <a href="<?php echo e(route('category.edit',['category'=>$category->id])); ?>">
                              <i class="fa fa-pencil"></i> Edit</a>
                        </label>
                     </div>
                     <?php echo $__env->make('includes.edit_children',[ 'collections' => $product->categories, 'obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category','name' => 'category_id', 'route' => 'category'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('backend/products.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>


if (document.getElementById('editor')) {
var quill = new Quill('#editor', {
theme: 'snow' // Specify theme in configuration
});
}

if (document.querySelector('.datetimepicker')) {
flatpickr('.datetimepicker', {
allowInput: true
}); // flatpickr
}
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/products/edit.blade.php ENDPATH**/ ?>