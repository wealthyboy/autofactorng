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
                        <select class="form-control" name="category" required>
                           <option value="general" {{ old('category', isset($order) ? $order->category : 'general') === 'general' ? 'selected' : '' }}>General</option>
                           <option value="indrive" {{ old('category', isset($order) ? $order->category : null) === 'indrive' ? 'selected' : '' }}>InDrive</option>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Subject</label>
                        <input type="text" value="{{ 'Confirmation Of Order' }}" class="form-control" name="subject" required>
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
                        <input type="number" class="form-control" required name="shipping_price">
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Heavy/Large Item</label>
                        <input type="number" class="form-control" name="heavy_item_price">
                     </div>
                  </div>
               </div>



               <hr class="horizontal dark">

               <div id="product-items" class="row mt-3 product-items align-items-start">

                  <h6>Product</h6>
                  <div class="col-sm-6 col-12 product-picker position-relative" data-product-picker>
                     <div class="input-group input-group-outline">
                        <label class="form-label">Search product name, SKU or barcode</label>
                        <input type="text" class="form-control order-product-search" autocomplete="off" required name="products[product_name][]">
                        <input type="hidden" class="order-product-id" name="products[product_id][]">
                     </div>
                     <div class="product-autocomplete-results d-none"></div>
                     <div class="mt-1 px-1">
                        <small class="text-muted product-selection-status">Select a catalogue result, or type the full name for an unlisted item.</small>
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
<script src="{{ asset('backend/products.js') }}?v={{ filemtime(public_path('backend/products.js')) }}"></script>
<script src="{{ asset('backend/order-product-picker.js') }}?v={{ filemtime(public_path('backend/order-product-picker.js')) }}"></script>
@stop
@section('page-styles')
<style>
   .product-autocomplete-results { position:absolute; z-index:1050; top:52px; left:12px; right:12px; max-height:300px; overflow-y:auto; background:#fff; border:1px solid #e2e6ed; border-radius:12px; box-shadow:0 18px 36px rgba(31,41,55,.14); }
   .product-autocomplete-option { width:100%; border:0; border-bottom:1px solid #f0f1f4; background:#fff; padding:12px 14px; display:flex; align-items:center; justify-content:space-between; text-align:left; cursor:pointer; }
   .product-autocomplete-option:hover { background:#f8f9fb; }
   .product-autocomplete-option:last-child { border-bottom:0; }
   .product-autocomplete-empty { padding:14px; color:#6b7280; }
</style>
@stop
@section('inline-scripts')


@stop
