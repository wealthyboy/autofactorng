@extends('layouts.auth')

@section('content')
<div class="container-fluid px-0">
   <div class="row">
      <div class="col-xl-5  col-lg-4 py-4">
         <a class="px-5" href="/">
            <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
         </a>
             
         <div class="card px-4 card-plain">
            <div class="card-header ">
               <h4 class="font-weight-bolder">Sign Up</h4>
               <p class="mb-0">Enter your email and password to subscribe</p>
            </div>
            <div class="card-body">
               <form role="form">
                  <div class="input-group input-group-outline mb-3">
                     <label class="form-label">Name</label>
                     <input type="text" class="form-control">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                     <label class="form-label">Email</label>
                     <input type="email" class="form-control">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                     <label class="form-label">Password</label>
                     <input type="password" class="form-control">
                  </div>
                  <div class="form-check form-check-info text-start ps-0">
                     <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="">
                     <label class="form-check-label" for="flexCheckDefault">
                     I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                     </label>
                  </div>
                  <div class="text-center">
                     <button type="button" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Subscribe</button>
                  </div>
               </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
               <p class="mb-2 text-sm mx-auto">
                  Already have an account?
               </p>
            </div>
         </div>

        
      </div>
      <div style="background-image: url('/images/utils/sign-in-background-img.jpeg'); background-size: cover; height: 100vh !important;"  class="col-12  col-md-7  position-relative bg-gradient-primary h-100  px-7 border-radius-lg d-flex flex-column justify-content-center">
               <h3 class="text-white mb-4"> Chosen plan </h3>
               <div class="card mb-3">
                  <div class="form-check mt-3 mb-2"">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1" checked>
                     <label class="custom-control-label text-dark" for="customRadio1">Light Duty   -   ₦50,000</label>
                  </div>
               </div>

               <div class="card mb-3">
                  <div class="form-check mt-3 mb-2">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2">
                     <label class="custom-control-label text-dark" for="customRadio2">Normal Duty - ₦150,000</label>
                  </div>
               </div>

               <div class="card mb-3">
                  <div class="form-check  mt-3 mb-2"">
                     <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio3">
                     <label class="custom-control-label text-dark" for="customRadio3">Heavy Duty - ₦350,000</label>
                  </div>
               </div>

               <p class="text-white ">
                  Nice choice. You can swap your plan any time during your subscription if you change your mind.
               </p>
         </div>
      </div>
     
   </div>
</div>

@endsection
