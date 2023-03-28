@extends('admin.layouts.invoice')
@section('content')

<div class="row">
   <div class="col-md-10 col-lg-8 col-sm-10 mx-auto">
      <form class="" action="index.html" method="post">
         <div class="card my-sm-5">
            <div class="card-header text-center">
               <div class="row justify-content-between">
                  <div class="col-md-4 text-start">
                     <img class="mb-2  p-2" src="https://autofactorng.com/images/afng_logo.png" alt="Logo">
                     <h6>
                        {{ $setting->address }}
                     </h6>
                     <p class="d-block text-secondary">
                        {{ $setting->store_phone }}
                     </p>
                  </div>
                  <div class="col-lg-3 col-md-7 text-md-end text-start mt-5">
                     <h6 class="d-block mt-2 mb-0">Billed to: {{ optional($order->user)->fullname() }}</h6>
                     <p class="text-secondary">
                        {{ $order->phone_number }}</br>
                        {{ $order->address }}<br>

                        {{ $order->city }}<br>
                        {{ $order->state }}
                     </p>
                  </div>
               </div>
               <br>
               <div class="row justify-content-md-between">
                  <div class="col-md-4 mt-auto">
                     <h6 class="mb-0 text-start text-secondary font-weight-normal">
                        Invoice no
                     </h6>
                     <h5 class="text-start mb-0">
                        #{{$order->invoice}}
                     </h5>
                  </div>
                  <div class="col-lg-5 col-md-7 mt-auto">

                     <div class="row text-md-end text-start">
                        <div class="col-md-6">
                           <h6 class="text-secondary font-weight-normal mb-0">Date:</h6>
                        </div>
                        <div class="col-md-6">
                           <h6 class="text-dark mb-0">{{ $order->created_at->format('d/m/y') }}</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-body">
               @include('admin._partials.t', ['models' => $ordered_products,'no_card' => false, 'name' => 'Items'])


            </div>
            <div class="card-footer mt-md-5 mt-1">
               <div class="row">
                  <div class="col-lg-12 text-left">
                     <h5>Thank you!</h5>
                     Dear {{ $order->user->fullname() }},
                     <p class=" text-sm">We hope that you enjoy your order</br>
                        Should you need any sort of further assistance, we are always ready to assist.</br>
                        You can reach us by phone at 09081155504, 09081155505 or by email at care@autofactorng.com
                        <br />Tapa House, Imam Dauda Street, Eric Moore, Surulere, Lagos State.<br />
                        Items must be returned within 5 working days after delivery.<br />
                        Thank you for shopping with us. Have a great day.<br />
                     </p>
                     <p> Sincerely, autofactorng
                     </p>


                  </div>

               </div>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
@section('inline-scripts')
@stop