<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('products.store')); ?>" class="" method="post" data-method="POST" enctype="multipart/form-data" id="form-product">
   <?php echo csrf_field(); ?>
   <div class="row">
      <div class="col-md-7">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               </div>
               <h6 class="mb-0">Add Product</h6>
            </div>
            <div class="card-body pt-0">
               <?php echo $__env->make('errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               <?php echo csrf_field(); ?>
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Name</label>
                        <input type="text" class="form-control" name="product_name" required id="product_name" data-msg="Upload  your image">
                     </div>
                     <div></div>
                  </div>
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="brand_id" id="">
                           <option value="">--Brand--</option>
                           <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option class="" value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?> </option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Note</label>
                        <input type="text" class="form-control" name="note" id="note">
                     </div>
                     <div></div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Price</label>
                        <input type="number" class="form-control" name="price" required>
                     </div>
                  </div>

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sale Price</label>
                        <input type="number" class="form-control" name="sale_price">
                     </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sales Start Date</label>
                        <input name="sale_price_starts" class="form-control datetimepicker" type="text" data-input>
                     </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sales End Date</label>
                        <input name="sale_price_ends" class="form-control datetimepicker" type="text" data-input>
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
                           <option class="" value="<?php echo e($amp); ?>"><?php echo e($amp); ?> </option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Radius</label>
                        <input type="number" class="form-control" name="radius">
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Width</label>
                        <input type="number" class="form-control" name="width">
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Height</label>
                        <input type="number" class="form-control" name="height">
                     </div>
                  </div>
               </div>


               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control" name="title">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Keywords</label>
                        <input type="text" class="form-control" name="keywords">

                        <input type="hidden" class="images" name="images">

                     </div>
                  </div>
               </div>



               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Meta Description</label>
                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control" name="meta_description" rows="8">Shop for Genuine Parts with Confidence. You Have The Cars. We Have Parts.</textarea>
                     </div>
                  </div>
               </div>


               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Description</label>
                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control" name="description" rows="8" required><?php echo e(isset($product) ? $product->description : old('description')); ?></textarea>
                     </div>
                  </div>
               </div>



               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Physical Description</label>

                     <div class="input-group input-group-outline">
                        <textarea style="width: 100%;" type="text" class="form-control" name="phy_desccfff" rows="8" id="phy_description">
                        </textarea>
                     </div>
                  </div>
               </div>




               <div class="col-12 my-3">
                  <?php echo $__env->make('admin.products.product_images', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>


               <div class="row my-3">
               </div>

               <hr class="horizontal dark">

               <?php echo $__env->make('admin._partials.is_featured', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


               <div class="form-check form-switch">
                  <input class="form-check-input" name="condition_is_present" value="1" type="checkbox" id="heavy_item">
                  <label class="form-check-label" for="heavy_item">Heavy/Large Item</label>
               </div>

               <div id="large-items" class="row mt-3 d-none large-items dup-lagos">

                  <h6>Lagos</h6>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[lagos][tag][]" id="" class="form-control">
                           <option value="quantity">Quantity</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[lagos][condition][]" id="" class="form-control">
                           <option value=">">greater than</option>
                           <option value="=">Equal to</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[lagos][tag_value][]" id="" class="form-control">
                           <option value="1">1</option>
                           <option value="2">2</option>
                           <option value="3">3</option>
                           <option value="4">4</option>
                           <option value="5">5</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="condition[lagos][price][]">
                     </div>
                  </div>
               </div>



               <div class="row button-lagos large-items my-3 d-none">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addRowLagos();" id="add-more-lagos" type="button" class="btn btn-outline-secondary">+Add more</button>
                  </div>
               </div>


               <div class="row large-items  d-none dup-out-lagos">
                  <h6 class="my-3">Outside Lagos</h6>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][tag][]" id="" class="form-control">
                           <option value="quantity">Quantity</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][condition][]" id="" class="form-control">
                           <option value=">">is greater than</option>
                           <option value="=">Equal to</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][tag_value][]" id="" class="form-control">
                           <option value="1">1</option>
                           <option value="2">2</option>
                           <option value="3">3</option>
                           <option value="4">4</option>
                           <option value="5">5</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="condition[out_side_lagos][price][]">
                     </div>
                  </div>
               </div>


               <div class="row button-lagos large-items my-3 d-none">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addRowOutSideLagos();" id="add-more-out-sidelagos" type="button" class="btn btn-outline-secondary">+Add more</button>
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
                                          <div class=" form-check">
                                             <label class="custom-control-label" for="<?php echo e($attribute->name); ?>-<?php echo e($attribute->id); ?>">
                                                <input data-name="<?php echo e($attribute->name); ?>" data-slug="<?php echo e($attribute->slug); ?>" class="form-check-input parent-attr" value="<?php echo e($attribute->id); ?>" type="checkbox" id="<?php echo e($attribute->name); ?>-<?php echo e($attribute->id); ?>" name="attribute_id[]">
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
                                             <?php echo $__env->make('includes.children',['obj'=>$attribute,'space'=>'&nbsp;&nbsp;','model' => 'attributes','url' => 'attribute','year' => true, 'name' => 'attribute_id','engine' => true, 'route' => 'attributes'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                  <div class="parent">
                     <div class="form-check ">
                        <label class="custom-control-label" for="<?php echo e($category->name); ?>-<?php echo e($category->id); ?>">
                           <input id="<?php echo e($category->name); ?>-<?php echo e($category->id); ?>" class="form-check-input category_parent  <?php echo e($category->name == 'Spare Parts' || $category->name == 'Servicing Parts'  ? 'no-validation' : ''); ?>" value="<?php echo e($category->id); ?>" type="checkbox" name="category_id[]">
                           <span role="button"><?php echo e($category->name); ?></span>
                           <a href="<?php echo e(route('category.edit',['category'=>$category->id])); ?>">
                              <i class="fa fa-pencil"></i> Edit</a>
                        </label>
                     </div>
                     <?php echo $__env->make('includes.children',['obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category','name' => 'category_id','route' => 'category'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
         </div>


         <div class="card mt-4">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">list</i>
               </div>
               <h6 class="mb-0">Related Products</h6>
            </div>
            <div class="material-datatables">
               <div class="categories fw-bold  text-sm text-danger px-4 "></div>

               <div class="well well-sm pb-5" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                  <div class="row p-attr">
                     <div class="col-md-12">
                        <div class="form-group py-2 px-3">

                           <div class="input-group input-group-outline">
                              <input name="search_products" type="text" value="" placeholder="Search" class="search_products form-control">
                           </div>
                           <div class="search_product">
                              <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                 <tbody id="related_products"></tbody>
                              </table>
                           </div>
                           <span class="material-input"></span>
                        </div>
                     </div>

                     <div class="col-sm-12">
                        <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                           <thead>
                              <tr>
                                 <td>
                                 </td>

                                 <td class="text-left"> Product Name</td>
                                 <!-- <td class="text-left"> Sort Order</td> -->
                                 <td class="text-left"> Action</td>
                              </tr>
                           </thead>
                           <tbody class="related_products">

                           </tbody>
                        </table>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
<script src="<?php echo e(asset('ckeditor/ckeditor.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/products/create.blade.php ENDPATH**/ ?>