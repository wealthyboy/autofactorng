@extends('layouts.app')

@section('content')

<section class="my-5">
    <div class="container">
        <div class="d-block d-sm-none">
            @include('_partials.mobile_nav')
        </div>
    </div>
    <div class="container ">
        <div class="row">

            @include('_partials.nav')

            <div class="col-md-9 bg--light  pb-3">
                <h2 class="page-title">Your Order</h2>
                <section class="top mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <h3>Shipping Address</h3>
                                <span id="">{{ $order->first_name }} {{ $order->last_name }}</span>
                                <br />{{ $order->address }}
                                <br /> {{ $order->city }} &nbsp;
                                <br /> {{ $order->state }},
                                </span>
                            </div>
                            <div class="col-4">
                                <h3>Payment Method</h3>
                                {{ $order->payment_type }}
                            </div>

                            <div class="col-4">
                                <h3>Cart Total</h3>
                                <span><span class="bold" id="subtotal">Subtotal:</span> ₦{{ $order->total }}</span></span> </br>
                                <span><span class="bold" id="subtotal">Shipping:</span> ₦{{ $order->ship_price }}</span></span> </br>
                                <span><span class="bold" id="subtotal">Coupon:</span> {{ $order->coupon ?  $order->coupon.'  -%'.$order->voucher()->amount .'  off' : '---' }}</span></span> </br>

                                <span><span class="bold" id="total">Total:</span> ₦{{ $order->get_total() }} </span>
                            </div>
                        </div>
                    </div>

                </section>
                <!--Breadcrumb-->

                <div class="card card-plain mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-left" scope="col">Order Date: {{ $order->created_at->format('m/d/Y') }}</th>
                                        <th colspan="1" class="text-right" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $order->ordered_products as $order_product )
                                    <tr>
                                        <th scope="row"><span class="bold">Status:</span> {{ $order_product->status }}</th>
                                        <td colspan="3">
                                            <div class="media">
                                                <div class="img-container">
                                                    <img class="align-self-start mr-3 img-fluid" src="{{ optional($order_product->product)->image_tn  }} " alt="{{ optional($order_product->product)->name  }}">
                                                </div>
                                                <div class="media-body ml-3 ">
                                                    <div class="font-weight-bolder">
                                                        <p class="font-weight-bolder"><span class="bold">Quantity: </span> {{ $order_product->quantity }}</span>
                                                        <p class="font-weight-bolder"><span class="bold">Price: &nbsp;</span> ₦{{ number_format($order_product->price) }}</p>

                                                    </div>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--End Contact Form & Info-->

@endsection