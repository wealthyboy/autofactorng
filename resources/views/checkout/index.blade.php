@extends('layouts.checkout')
@section('content')
<div class="checkout  bg-light bg-gradient">
<div class="container-fluid   mt-1">
<div class="row    align-items-start">
   <div class="col-12 col-md-7 rounded-top">
      <div class="col-md-12 card m7 mb-2 border-gray mb-2">
         <div class="border-bottom pt-2 px-3">
            <h4 class="font-weight-bolder">SHIPPING ADDRESS</h4>
         </div>
         <div id="stored_address" class="billing-fields__field-wrapper p-3">
            <h6>SHIPPING ADDRESS:</h6>
            <form method="POST">
               <div id="add-new-address-form" data-action="/address/create" class="row no-gutters">
                  <div class="col-6 mb-4 pl-1">
                     <div class="input-group input-group-outline "><label class="form-label">First Name</label> <input type="text" class="form-control"></div>
                  </div>
                  <div class="col-6 mb-4 pr-1">
                     <div class="input-group input-group-outline "><label class="form-label">Last Name</label> <input type="text" name="last_name" class="form-control"></div>
                  </div>
                  <div class="col-6 mb-4">
                     <div class="input-group input-group-outline "><label class="form-label">Email</label> <input type="text" class="form-control"></div>
                  </div>
                  <div class="col-6 mb-4">
                     <div class="input-group input-group-outline "><label class="form-label">Phone number</label> <input type="text" name="last_name" class="form-control"></div>
                  </div>
                  <div class="col-12 mb-4">
                     <div class="input-group input-group-outline"><label class="form-label">Address</label> <input type="text" name="last_name" class="form-control"></div>
                  </div>
                  <div class="col-12 mb-4">
                     <div class="input-group input-group-outline "><label class="form-label">City</label> <input type="text" name="last_name" class="form-control"></div>
                  </div>
                  <div class="col-12 mb-4">
                     <div class="input-group input-group-outline "><label class="form-label">Land mark</label> <input type="text" name="last_name" class="form-control"></div>
                  </div>
                  <div class="col-12 mb-4">
                     <div class="input-group input-group-outline ">
                        <!-- <label class="form-label">State/Region</label>  -->
                        <select name="state_id" id="state_id" class="form-control required">
                           <option value="" selected="selected">Select a state</option>
                           <option value="2">Abia</option>
                           <option value="19">Adamawa</option>
                           <option value="20">Akwa Ibom</option>
                           <option value="21">Anambra</option>
                           <option value="97">Awka</option>
                           <option value="22">Bauchi</option>
                           <option value="16">Bayelsa</option>
                           <option value="17">Benue</option>
                           <option value="24">Borno</option>
                           <option value="18">Cross river</option>
                           <option value="13">Delta</option>
                           <option value="32">Ebonyi</option>
                           <option value="11">Edo</option>
                           <option value="27">Ekiti</option>
                           <option value="31">Enugu</option>
                           <option value="9">FCT</option>
                           <option value="23">Gombe</option>
                           <option value="112">Ilorin</option>
                           <option value="33">Imo</option>
                           <option value="104">Jigawa</option>
                           <option value="14">Kaduna</option>
                           <option value="110">Kano</option>
                           <option value="39">Kastina</option>
                           <option value="111">Katsina</option>
                           <option value="105">Kebbi</option>
                           <option value="10">KOGI</option>
                           <option value="35">Kwara</option>
                           <option value="3">Lagos</option>
                           <option value="106">Nasarawa</option>
                           <option value="107">Niger</option>
                           <option value="26">Ogun</option>
                           <option value="28">Ondo</option>
                           <option value="29">Osun</option>
                           <option value="15">Oyo</option>
                           <option value="40">Plateau</option>
                           <option value="108">Port Harcourt</option>
                           <option value="12">Rivers</option>
                           <option value="109">Sokoto</option>
                           <option value="36">Taraba</option>
                           <option value="94">Umuahia</option>
                           <option value="38">Yobe</option>
                           <option value="37">zamfara</option>
                        </select>
                     </div>
                  </div>
                  <div class=" col-12 col-md-12 d-flex justify-content-end"><button type="button" class="btn btn-primary btn-lg">Save</button></div>
               </div>
            </form>
         </div>
      </div>
      <div class="col-md-12 card border-top">
         <div class="border-bottom pt-2 px-3">
            <h4 class="font-weight-bolder">PAYMENT</h4>
         </div>
         <div id="add-new-address-form" class="row px-3">
            <div class="form-field-wrappercol-sm-12">
               <div class="row cart-rows  mb-2 pt-4 pb-2">
                  <div class="col-md-3 col-6">
                     <div class="cart-image"><img src="https://magnetictheme.net/chakta/assets/images/shop/products-27.jpg" alt="" class="img-fluid"></div>
                  </div>
                  <div class="col-md-8 col-6">
                     <div class="tag mb-1 brand-name bold color--gray"></div>
                     <div class="mb-1"><a href="#">Spherical Roller Bearing</a></div>
                     <div class="product-item-prices">
                        <div class="product--price--amount"><span class="retail--title text-gold">PRICE</span> <span class="product--price">₦7,000</span> <span class="retail--title"></span></div>
                     </div>
                  </div>
               </div>
               <p class="border-bottom pb-3 d-flex justify-content-between"><span class="bold" style="font-size: 22px;">Subtotal</span> <span class="float-right"><span class="currencySymbol f-20 bold" style="font-size: 22px;">₦7,000</span></span></p>
               <div class="border-bottom pb-3"><span class="bold"></span> <span class="float-right"><span>Shipping is based on your location</span></span></div>
               <h4 class="py-2">Choose Payment Method</h4>
               <div class="card mb-3">
                  <div class="form-check mt-3 mb-2"><input type="radio" name="flexRadioDefault" id="customRadio1" class="form-check-input diff-pay"> <label for="customRadio1" class="custom-control-label">Debit/Credit Card Payment</label></div>
               </div>
               <div class="card mb-3">
                  <div class="form-check mt-3 mb-2"><input type="radio" name="flexRadioDefault" id="Pay_On_Delivery" class="form-check-input diff-pay"> <label for="Pay_On_Delivery" class="custom-control-label"> Pay On Delivery (Lagos only)</label></div>
               </div>
               <div class="card mb-3 ">
                  <div class="form-check f mt-3 mb-2"><input type="radio" name="flexRadioDefault" id="Wallet" class="form-check-input diff-pay"> <label for="Wallet" class="custom-control-label">Wallet</label></div>
               </div>
               <div class="card mb-3 ">
                  <div class="form-check mt-3 mb-2"><input type="radio" name="flexRadioDefault" id="buy_now_pay_later" class="form-check-input"> <label for="buy_now_pay_later" class="custom-control-label">Buy now pay later</label></div>
               </div>
               <div class=" buy_now_pay_later d-none">
                  <h4>Enter your details</h4>
                  <p>For you to be eligible for after pay please fill the form below for verification</p>
                  <div>
                     <form method="POST">
                        <div class="col-12 mb-3 pl-1 mb">
                           <div class="input-group input-group-outline "><label class="form-label">Phone Number</label> <input type="text" class="form-control"></div>
                        </div>
                        <div class="col-12 mb-2 pr-1">
                           <div class="input-group input-group-outline "><label class="form-label">BVN</label> <input type="text" name="last_name" class="form-control"></div>
                        </div>
                        <div class=" col-12 col-md-12 d-flex justify-content-end"><button type="button" class="btn btn-primary btn-lg">Verify</button></div>
                     </form>
                  </div>
               </div>
               <div class="cart-discount p-0  mt-3 col-sm-12">
                  <h5>Apply Discount Code</h5>
                  <div class="input-group">
                     <input type="text" placeholder="Enter  code" required="required" class="form-control"> 
                     <div class="input-group-append"><button type="submit" class="btn btn-sm btn-primary">
                        Apply 
                        </button>
                     </div>
                  </div>
               </div>
               <div class="pb-4 d-flex justify-content-between"><span class="bold fa-2x text-dark">Total</span> <span class="price-amount amount bold float-right"><span class="currencySymbol fa-2x">₦7,000
                  </span></span>
               </div>
            </div>
            <p class="form-field-wrapper   col-sm-12 mb-3"><button type="button" class="btn btn-primary btn-lg w-100"> Complete Purchase</button></p>
            <div data-testid="hidden-root" class="az_eP">
               <div id="htmlBlock" class="a">
                  <div data-testid="contactUs-container" class="az_Rr ">
                     <h2><span class="az_J">QUESTIONS ?</span></h2>
                     <p class="az_-i az_Tr">Contact us at +234 803 755 7788 or <a href="/contactus" target="">customer.service@autofactorng.com</a></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-5 ">
      <div class="col-md-12 bg-white d-none d-lg-block  card mb-3">
         <div class="border-bottom pt-2 px-3">
            <h4 class="font-weight-bolder">ORDER SUMMARY</h4>
         </div>
         <div class="cart-collateralse px-3">
            <div class="cart_totalse">
               <div class="row cart-rows  mb-2 pt-4 pb-2 border-top border-gray">
                  <div class="col-md-3 col-6">
                     <div class="cart-image"><img src="https://magnetictheme.net/chakta/assets/images/shop/products-27.jpg" alt="" class="img-fluid"></div>
                  </div>
                  <div class="col-md-9 col-6">
                     <div class="tag mb-1 brand-name bold color--gray"></div>
                     <div><a href="#">Spherical Roller Bearing</a></div>
                     <div class="product-item-prices">
                        <div class="product--price--amount"><span class="retail--title text-gold">PRICE</span> <span class="product--price">₦7,000</span> <span class="retail--title"></span></div>
                     </div>
                  </div>
               </div>
               <p class="pt-3 pb-1  d-flex justify-content-between"><span class="bold" style="font-size: 22px;">Subtotal</span> <span class="bold float-right"><span class="currencySymbol">₦7,000</span></span></p>
               <p class="border-top border-bottom pb-3 pt-3"><span class="bold"></span> <span class=" float-right"><small> Shipping is based on your location</small></span></p>
               <p class="pb-4 d-flex justify-content-between"><span class="bold " style="font-size: 28px;">Total</span> <span class="price-amount amount bold float-right"><span class="currencySymbol" style="font-size: 28px;">₦7,000</span></span></p>
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

(function ($) {
    "use strict";

    jQuery(function () {
         $('#buy_now_pay_later').change(function() {
            $('.buy_now_pay_later').removeClass('d-none')
         });

         $('.diff-pay').on('change', function() {
            $('.buy_now_pay_later').addClass('d-none')
         })
    });
})(jQuery);

@stop

