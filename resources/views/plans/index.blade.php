@extends('layouts.general')

@section('content')
    
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto text-center">
        <h3>Pick the best plan for you</h3>
        <p></p>
      </div>
    </div>
    
    <div class="row mt-5">
      <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
        <div class="card h-100">
          <div class="card-header text-sm-start text-center pt-4 pb-3 px-4">
            <h5 class="mb-1">Light Duty</h5>
            <p class="mb-3 text-sm">Auto parts cover subscription premium</p>
            <h3 class="font-weight-bolder mt-3">
            ₦50,000 <small class="text-sm text-secondary font-weight-bold">/ year</small>
            </h3>
            <a href="/subscribe" class="btn btn-sm bg-gradient-dark w-100 border-radius-md mt-4 mb-2">Buy now</a>
          </div>
          <hr class="horizontal dark my-0">
          <div class="card-body">
           

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm ps-3">One free diagnosis within validity period</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm ps-3">Keep track of your purchase history</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm ps-3">Access to tons of vehicle repair guides</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm ps-3">Get exclusive deals and offers</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
        <div class="card bg-gradient-dark h-100">
          <div class="card-header bg-transparent text-sm-start text-center pt-4 pb-3 px-4">
            <h5 class="mb-1 text-white">Normal Duty</h5>
            <p class="mb-3 text-sm text-white">Auto parts cover subscription premium</p>
            <h3 class="font-weight-bolder mt-3 text-white">
            ₦150,000 <small class="text-sm text-white font-weight-bold">/ year</small>
            </h3>
            <a href="/subscribe" class="btn btn-sm btn-white w-100 border-radius-md mt-4 mb-2">Buy now</a>
          </div>
          <hr class="horizontal light my-0">
          <div class="card-body">
          
            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-white">done</i>
              <span class="text-sm text-white ps-3">Three free diagnosis within validity period</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-white">done</i>
              <span class="text-sm text-white ps-3">Keep track of your purchase history</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-white">done</i>
              <span class="text-sm text-white ps-3">Access to tons of vehicle repair guides</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-white">done</i>
              <span class="text-sm text-white ps-3">Get exclusive deals and offers</span>
            </div>

            

          </div>
        </div>
      </div>

      <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
        <div class="card h-100">
          <div class="card-header text-sm-start text-center pt-4 pb-3 px-4">
            <h5 class="mb-1">Heavy Duty</h5>
            <p class="mb-3 text-sm">Auto parts cover subscription premium</p>
            <h3 class="font-weight-bolder mt-3">
            ₦350,000 <small class="text-sm text-secondary font-weight-bold">/ year</small>
            </h3>
            <a href="/subscribe" class="btn btn-sm bg-gradient-dark w-100 border-radius-md mt-4 mb-2">Buy now</a>
          </div>
          <hr class="horizontal dark my-0">
          <div class="card-body">
            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm ps-3">One free towing service within lagos</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm ps-3">Five free diagnosis within validity period</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm text-dark ps-3">Keep track of your purchase history</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm text-dark ps-3">Access to tons of vehicle repair guides</span>
            </div>

            <div class="d-flex pb-3">
              <i class="material-icons my-auto text-dark">done</i>
              <span class="text-sm text-dark ps-3">Get exclusive deals and offers</span>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <p class="text-dark">
            Autofactor Cover is our subscription program that helps you get more for buying what you need. It gives you the freedom you need to drive without worries. We’ll ensure you have an auto-parts cover to the tune of your subscription with an extra 10% of your annual insurance policy from us to enable you to fix your car issues on the go.
        </p>
        <p class="text-dark">    
            
        Other benefits include free towing services, free diagnosis within the validity period, and receive access to exclusive offers just for you. If you need help keeping track of your purchases, our program helps you do that. These are just a few benefits of joining as subscribers.
        </p>
      </div>

      
    </div>
  </div>
</section>
   
@endsection
