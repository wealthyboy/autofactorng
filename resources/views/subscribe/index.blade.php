@extends('layouts.auth')

@section('content')
<div class="container-fluid px-0">
   <div class="row">
      <div class="col-xl-5  col-lg-4 ">

         @include('_partials.back')

         <div class="content p-5">
            <div class="logo ">
               <a class="px-5" href="/">
                  <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
               </a>
            </div>

           

            @if ( session('plan'))
            <div class="row mb-5" id="signInMessage">
               <span class="sign-in-prompt" data-testid="sign-in-message">You already Subscribed</span>
            </div>

            @endif



            @if ($user && !$user->hasActiveSubscription())
            <div class="row mb-5" id="signInMessage">
               <span class="sign-in-prompt" data-testid="sign-in-message">Enter your subscription amount:</span>
            </div>
            <wallet :auto_credit="true" :user="{{ $user }}" :price_range="{{ collect($price_range) }}"></wallet>

            @endif


            @guest
            <div class="row mb-5" id="signInMessage">
               <span class="sign-in-prompt" data-testid="sign-in-message">Welcome.</span>
            </div>
            <subscribe :price_range="{{ collect($price_range) }}"></subscribe>
            @endguest


         </div>

      </div>
      <div class="position-relative  d-none d-lg-block d-md-block d-xl-block col-12  col-md-7  position-relative bg-gradient-primary h-100  px-7 border-radius-lg" style="background-image: url(&quot;/images/utils/register_autofactorng.jpeg&quot;); background-size: cover; background-repeat: no-repeat; height: 100vh !important; background-position: center center;     background-position: -10px 0px;">
         <div class="image-overlay d-flex align-items-center">

            <div class="text text-white ">
               <div class="d-flex align-items-center flex-column me-5">
                  <div class="fs-4 mb-5 w-75">
                     At Autofactor, we have an extensive inventory of over 50,000 items to cater to your needs, whether online or at our physical store. Also, you'll have access to a range of exclusive benefits and incentives that are designed to make your shopping experience even better.
                     Sign up today to enjoy this and get even more great benefits.
                  </div>
                  <div class="member-heading">
                     <h1 class="text-white ms-5 display-3 "> MEMBER BENEFITS: </h1>
                  </div>
               </div>

               <ul>
                  <li class="d-flex align-items-center justify-content-center mb-5">
                     <div class="right-content-icons">
                        <i class="material-symbols-outlined display-1">
                           payments
                        </i>
                     </div>
                     <div class="bullet-text w-50 ms-4 fs-4">Discounts and offers: Receive exclusive discounts on auto parts and accessories. </div>
                  </li>
                  <li class="d-flex align-items-center justify-content-center mb-5">
                     <div class="right-content-icons">
                        <span class="material-symbols-outlined display-1">
                           login
                        </span>
                     </div>
                     <div class="bullet-text w-50 ms-4 fs-4"> Priority access: You'll be the first to know about new products, limited-time offers, and other special promotions.</div>
                  </li>
                  <li class="d-flex align-items-center justify-content-center">
                     <div class="right-content-icons">
                        <span class="material-symbols-outlined display-1">
                           recommend
                        </span>
                     </div>
                     <div class="bullet-text w-50 ms-4 fs-4"> Personalized product recommendations based on your previous purchases and preferences.</div>
                  </li>
               </ul>
            </div>

         </div>
      </div>

   </div>
</div>
@endsection