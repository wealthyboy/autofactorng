@extends('layouts.app')
 
@section('content')
<div class="sec-padding--account bg--gray">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    @include('account.nav')
                </div>
                <div class="col-md-9  ">
                <h2 class="">Orders </h2>
                <div class="card card-plain">


                @if ($orders->count() )
                    <div class="table-responsive">
                        <table  id="" class="table table-shopping table-striped">
                            <thead>
                                <tr>
                                    <td class="text-left bold text-uppercase">Order ID</td>
                                    <td class="text-left bold">CUSTOMER</td>
                                    <td class="text-left bold">DATE ADDED</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td class="text-left">#{{ $order->id }}</td>
                                    <td class="text-left">{{ Auth::user()->fullname() }}</td>
                                    <td class="text-left">{{ $order->created_at->format('d/m/y') }}</td>
                                    <td class="text-right"><a href="/fashion/order/{{ $order->id}}"  class=" p-5"><i class="fa fa-eye"></i> view</a></td>
                                </tr>
                                @endforeach
                                    
                            </tbody>
                        </table>
                    </div> 
                    @else
                        <div class="text-center d-flex justify-content-center">
                            <img  width="200" height="200" src="/images/utilities/empty_product.svg" /> 
                        </div>
                        <p class="text-center">No orders yet</p>

                    @endif  
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<!--End & Info-->

@endsection