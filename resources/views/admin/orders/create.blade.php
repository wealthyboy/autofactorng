@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.orders.store') }}" class="order-admin-form" method="post">
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
                        <label class="form-label" for="to">Customer Email</label>
                        <input type="text" class="form-control" value="{{ isset($order) ? $order->email : null }}" name="email" required id="to">
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        @php
                           $selectedCategory = old('category', isset($order) ? $order->category : '');
                           $selectedCategory = $selectedCategory === 'general' ? 'private' : $selectedCategory;
                        @endphp
                        <label class="form-label" for="order-customer-type">Customer Type</label>
                        <select class="form-control" name="category" id="order-customer-type" required>
                           <option value="" disabled {{ $selectedCategory === '' ? 'selected' : '' }}>Choose one</option>
                           <option value="private" {{ $selectedCategory === 'private' ? 'selected' : '' }}>Private</option>
                           <option value="business" {{ $selectedCategory === 'business' ? 'selected' : '' }}>Business</option>
                           <option value="indrive" {{ $selectedCategory === 'indrive' ? 'selected' : '' }}>InDrive</option>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label" for="order-subject">Subject</label>
                        <input id="order-subject" type="text" value="{{ 'Confirmation Of Order' }}" class="form-control" name="subject" required>
                     </div>
                  </div>

                  <div class="col-sm-12 mt-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label" for="order-full-name">Full Name</label>
                        <input id="order-full-name" type="text" value="{{ isset($order) ? $order->first_name : null }}" class="form-control" required name="first_name">
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label" for="order-phone-number">Phone Number</label>
                        <input id="order-phone-number" name="phone_number" value="{{ isset($order) ? $order->phone_number : null }}" class="form-control " type="text" required>
                     </div>
                  </div>
                  <div class="col-sm-12 col-12 mt-3">
                     <div class="input-group input-group-outline">
                        <label class="form-label" for="order-payment-type">Payment Type</label>
                        <input id="order-payment-type" name="payment_type" value="{{  isset($order) ? $order->payment_type : null }}" class="form-control" type="text" required>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" value="{{ isset($order) ? $order->address : null }}" class="form-control" name="address" id="address" required>
                     </div>
                  </div>


               </div>

               <div class="row mt-3">
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label" for="order-discount-type">Discount Type</label>
                        <select class="form-control" name="percentage_type" id="order-discount-type">
                           <option value="">Choose one</option>
                           <option value="percentage">Percentage</option>
                           <option value="fixed">Fixed</option>

                        </select>
                     </div>
                  </div>

                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Discount</label>
                        <input type="number" class="form-control" name="discount">
                     </div>
                  </div>

                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Shipping</label>
                        <input type="number" class="form-control" required name="shipping_price">
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Heavy/Large Item Charge</label>
                        <input type="number" class="form-control" name="heavy_item_price">
                     </div>
                  </div>
               </div>



               <hr class="horizontal dark">

               <div id="product-items" class="row mt-3 product-items align-items-start">

                  <h6>Product</h6>
                  <div class="col-sm-6 col-12 product-picker position-relative" data-product-picker>
                     <div class="input-group input-group-outline">
                        <label class="form-label">Product</label>
                        <input type="text" class="form-control order-product-search" autocomplete="off" required name="products[product_name][]">
                        <input type="hidden" class="order-product-id" name="products[product_id][]">
                        <input type="hidden" class="order-product-sort-order" name="products[sort_order][]" value="0">
                     </div>
                     <div class="product-autocomplete-results d-none"></div>
                     <div class="mt-1 px-1">
                        <small class="text-muted product-selection-status">Select a catalogue result, or type the full name for an unlisted item.</small>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Quantity</label>
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
   /* Keep labels visible without adding a full extra line above every field. */
   .order-admin-form .input-group.input-group-outline {
      position: relative;
      display: block;
      min-height: 0 !important;
      margin: 0 !important;
      padding-top: 0.45rem !important;
      border: 0 !important;
   }
   .order-admin-form .input-group.input-group-outline .form-label,
   .order-admin-form .input-group.input-group-outline.is-filled .form-label,
   .order-admin-form .input-group.input-group-outline.is-focused .form-label {
      position: absolute !important;
      top: 0 !important;
      left: 0.65rem !important;
      z-index: 20 !important;
      display: inline-block !important;
      width: auto !important;
      height: auto !important;
      margin: 0 !important;
      padding: 0 0.3rem !important;
      transform: none !important;
      background: #fff !important;
      font-size: 0.72rem !important;
      line-height: 1.05 !important;
      font-weight: 700 !important;
      color: #344767 !important;
      opacity: 1 !important;
      visibility: visible !important;
      pointer-events: none !important;
   }
   .order-admin-form .input-group.input-group-outline .form-label::before,
   .order-admin-form .input-group.input-group-outline .form-label::after {
      content: none !important;
      display: none !important;
   }
   .order-admin-form .input-group.input-group-outline .form-control {
      width: 100%;
      min-height: 40px !important;
      height: 40px;
      padding: 0.5rem 0.7rem !important;
      background: #fff !important;
      border: 1px solid #d2d6da !important;
      border-radius: 0.45rem !important;
      box-shadow: none !important;
      line-height: 1.2 !important;
      position: relative !important;
      z-index: 1 !important;
   }
   .order-admin-form .input-group.input-group-outline.is-filled .form-label + .form-control,
   .order-admin-form .input-group.input-group-outline.is-focused .form-label + .form-control {
      border-color: #d2d6da !important;
      border-top-color: #d2d6da !important;
      box-shadow: none !important;
   }
   .order-admin-form .input-group.input-group-outline .form-control:focus {
      border-color: #344767 !important;
      box-shadow: 0 0 0 2px rgba(52, 71, 103, 0.06) !important;
   }
   /* Keep browser autofill from painting saved values blue/yellow. */
   .order-admin-form input.form-control:-webkit-autofill,
   .order-admin-form input.form-control:-webkit-autofill:hover,
   .order-admin-form input.form-control:-webkit-autofill:focus,
   .order-admin-form input.form-control:-webkit-autofill:active {
      -webkit-text-fill-color: #344767 !important;
      -webkit-box-shadow: 0 0 0 1000px #fff inset !important;
      box-shadow: 0 0 0 1000px #fff inset !important;
      background-color: #fff !important;
      transition: background-color 9999s ease-out 0s;
   }
   .order-admin-form select.form-control {
      cursor: pointer;
   }

   /* The order form is intentionally compact; labels must not double its vertical height. */
   .order-admin-form .row.mt-3 {
      margin-top: 0.7rem !important;
   }
   .order-admin-form .col-sm-12.mt-3,
   .order-admin-form .col-12.mt-3 {
      margin-top: 0.7rem !important;
   }
   .order-admin-form hr.horizontal {
      margin: 1rem 0 !important;
   }
   .product-autocomplete-results { position:absolute; z-index:1050; top:50px; left:12px; right:12px; max-height:300px; overflow-y:auto; background:#fff; border:1px solid #e2e6ed; border-radius:12px; box-shadow:0 18px 36px rgba(31,41,55,.14); }
   .product-autocomplete-option { width:100%; border:0; border-bottom:1px solid #f0f1f4; background:#fff; padding:12px 14px; display:flex; align-items:center; justify-content:space-between; text-align:left; cursor:pointer; }
   .product-autocomplete-details { display:flex; align-items:center; gap:12px; min-width:0; }
   .product-autocomplete-image { width:48px; height:48px; flex:0 0 48px; border-radius:8px; object-fit:cover; border:1px solid #eceef2; }
   .product-autocomplete-option:hover { background:#f8f9fb; }
   .product-autocomplete-option:last-child { border-bottom:0; }
   .product-autocomplete-empty { padding:14px; color:#6b7280; }
</style>
@stop
@section('inline-scripts')


@stop
