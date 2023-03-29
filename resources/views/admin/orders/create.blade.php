@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.orders.store') }}" class="" method="post">
   @csrf
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
               @include('errors.errors')
               @csrf
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> To</label>
                        <input type="text" class="form-control" value="{{ isset($order) ? $order->email : null }}" name="email" required id="to">
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Subject</label>
                        <input type="text" value="{{ isset($order) ? $order->subject : 'Thanks For Ordering' }}" class="form-control" name="subject" required>
                     </div>
                  </div>

                  <div class="col-sm-12 mt-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Full name</label>
                        <input type="text" value="{{ isset($order) ? $order->first_name : null }}" class="form-control" required name="first_name">
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Phone Number</label>
                        <input name="phone_number" value="{{ isset($order) ? $order->phone_number : null }}" class="form-control " type="text" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Payment</label>
                        <input name="payment_type" value="{{  isset($order) ? $order->payment_type : null }}" class="form-control" type="text" required>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Address</label>
                        <input type="text" value="{{ isset($order) ? $order->address : null }}" class="form-control" name="address" id="address" required>
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <select class="form-control" name="percentage_type" id="">
                           <option value="">--Type--</option>
                           <option value="percentage">Percentage</option>
                           <option value="fixed">Fixed</option>

                        </select>
                     </div>
                  </div>

                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Discount</label>
                        <input type="number" class="form-control" name="discount">
                     </div>
                  </div>

                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Shipping</label>
                        <input type="number" class="form-control" name="shipping_price">
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Heavy/Large Item</label>
                        <input type="number" class="form-control" name="heavy_or_large_item">
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




@endsection
@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="{{ asset('backend/products.js') }}"></script>
@stop
@section('inline-scripts')


@stop