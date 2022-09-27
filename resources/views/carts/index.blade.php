@extends('layouts.checkout')
@section('content')
<div class="checkout  bg-light bg-gradient">
   <div class="container-fluid   mt-1">
      <div class="row    align-items-start">
         <div class="col-12 col-md-8 rounded-top">
            <div class="col-md-12 card m7 mb-2 border-gray mb-2">
               
               <div id="stored_address" class="billing-fields__field-wrapper p-3">
                  <div class="row cart-rows raised bg--light mb-3 pt-4 pb-4 border border-gray">
                     <div class="col-md-3 col-6">
                        <div class="cart-image">
                            <img class="img-fluid" src="https://autofactor.ng/images/products/m/ATlkPupEBI6E9wbYABIrzYPPJ4DNG33xpddTGGos.png" alt="">
                        </div>
                     </div>
                     <div class="col-md-6 col-6">
                        <h5><a href="#">BLACK/WHITE CELINE SIDE CUT OUT TWO TONE BODYCON DRESS HS-GQID</a></h5>
                        <div class="product--share"><span class="bold">Item #:</span> JOXi2z
                        </div>
                        <div class="product-item-price">
                           <div class="product-price-amount"><span class="retail-title text-gold">PRICE</span> <span class="product--price">₦9,000</span> <span class="retail-title"></span></div>
                        </div>
                        <p> White,Medium</p>
                     </div>
                     <div class="col-md-2">
                        <div class="pt-2 pb-4 form-group">
                           <label class="bold">Qty</label> 
                           <div id="quantity_1234" class="product-quantity select-custom">
                              <select id="add-to-cart-quantity" name="qty" class="input--lg form-control">
                                 <option>1</option>
                                 <option>2</option>
                                 <option>3</option>
                                 <option>4</option>
                                 <option>5</option>
                                 <option>6</option>
                              </select>
                           </div>
                        </div>
                        <div><a href="#" class=" text-danger btn-transparent bold"><span class="button-icon"><i class="far fa-trash-alt"></i></span>
                           Remove 
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
           
         </div>
         <div class="col-4">
            <div class="col-md-12 bg-white d-none d-lg-block  card mb-3">
               <div class="border-bottom pt-2 px-3">
                  <h4 class="font-weight-bolder">ORDER SUMMARY</h4>
               </div>
               <div class="cart-collateralse px-3">
                  <div class="cart_totalse">
                     <p class="pt-3 pb-1  d-flex justify-content-between"><span class="bold" style="font-size: 22px;">Subtotal</span> <span class="bold float-right"><span class="currencySymbol">₦7,000</span></span></p>
                     <p class="border-top border-bottom pb-3 pt-3"><span class="bold"></span> <span class=" float-right"><small> Shipping is based on your location</small></span></p>
                     <a href="/checkout"  class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Checkout</a>
                     <div class="proceed-to-checkout"></div>
                  </div>

                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')

@stop