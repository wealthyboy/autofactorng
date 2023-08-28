 @extends('layouts.app')

 @section('content')
 <section class="header container-fluid py-3">
     <div class="">
         <a href="/" class="d-flex  align-items-center cursor-pointer ">
             <span class="material-symbols-outlined text-main">keyboard_backspace</span>
             <h6 class="mb-3 fs-3  mt-3 text-uppercase">KEEP SHOPPING</h6>
         </a>
     </div>
     <h4 class="text-uppercase  mb-0 mb-3 display-4"> MY <strong> CART </strong></h4>
 </section>



 <!--Content-->

 <section class="bg-light">
     <div class="container-fluid ">
         <cart-summary />
     </div>

 </section>
 <!--End Content-->
 @endsection