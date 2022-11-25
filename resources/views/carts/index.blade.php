 @extends('layouts.app')

 @section('content')
 <section class="header p-5">
     <div>MY</div>
     <h2>CART</h2>
 </section>



 <!--Content-->

 <section class="">
     <div class="container-fluid">
         <div id="js-loading" class="full-bg">
             <div class="signup--middle">
                 <div class="loading">
                     <div class="loader"></div>
                 </div>
                 <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="Afng">
             </div>
         </div>
         <cart-summary />

     </div>

 </section>
 <!--End Content-->
 @endsection