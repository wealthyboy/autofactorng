<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.orders.store')); ?>" class="" method="post">
   <?php echo csrf_field(); ?>
   <div class="row">
      <div class="col-md-10">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined opacity-10">shopping_cart</i>
               </div>
               <h6 class="mb-0">Add Order</h6>
            </div>
            <div class="card-body pt-0">
               <?php echo $__env->make('errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               <?php echo csrf_field(); ?>
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> To</label>
                        <input type="text" class="form-control" value="<?php echo e(isset($order) ? $order->email : null); ?>" name="email" required id="to">
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Subject</label>
                        <input type="text" value="<?php echo e(isset($order) ? $order->subject : 'Thanks for ordering'); ?>" class="form-control" name="subject" required>
                     </div>
                  </div>

                  <div class="col-sm-12 mt-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Full name</label>
                        <input type="text" value="<?php echo e(isset($order) ? $order->first_name : null); ?>" class="form-control" name="first_name">
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Phone Number</label>
                        <input name="phone_number" value="<?php echo e(isset($order) ? $order->phone_number : null); ?>" class="form-control " type="text">
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Payment</label>
                        <input name="payment_type" value="<?php echo e(isset($order) ? $order->payment_type : null); ?>" class="form-control" type="text">
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Address</label>
                        <input type="text" value="<?php echo e(isset($order) ? $order->address : null); ?>" class="form-control" name="address" id="address">
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Land Mark</label>
                        <input type="text" value="<?php echo e(isset($order)? $order->landmark : null); ?>" class="form-control" name="landmark" id="land_mark">
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <select class="form-control" name="percentage_type" id="">
                           <option value="">--Type--</option>
                           <option value="percentage">Percentage</option>
                           <option value="fixed">Fixed</option>

                        </select>
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Discount</label>
                        <input type="number" class="form-control" name="discount">
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Shipping</label>
                        <input type="number" class="form-control" name="shipping_price">
                     </div>
                  </div>
               </div>



               <hr class="horizontal dark">

               <div id="product-items" class="row mt-3 product-items">

                  <h6>Product</h6>
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Name</label>
                        <input type="text" class="form-control" required name="products[product_name][]">
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Quantity</label>
                        <input type="number" class="form-control" required name="products[quantity][]">
                     </div>
                  </div>

                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" required name="products[price][]">
                     </div>
                  </div>
               </div>

               <div class="row button-lagos large-items my-3 ">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addProductRow();" id="add-more-lagos" type="button" class="btn btn-outline-secondary">+Add more</button>
                  </div>
               </div>

               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="submit" id="" class="btn bg-gradient-dark m-0 ms-2">
                     <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                     <span id="submit-product-form-text">Submit</span>
                  </button>
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
<script src="<?php echo e(asset('backend/products.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inline-scripts'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/orders/create.blade.php ENDPATH**/ ?>