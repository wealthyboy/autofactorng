 @extends('layouts.app')

 @section('content')
 <section class="header p-5">
     <h4 class="text-uppercase  mb-0 mb-3 display-4"> MY <strong> CART </strong></h4>
 </section>



 <!--Content-->

 <section class="">
     <div class="container-fluid">
         <cart-summary />
     </div>

 </section>
 <!--End Content-->
 @endsection