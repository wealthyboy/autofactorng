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

            <div class="col-md-9">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="page-title ">Wallet</h2>
                    <div class="wallet-balance">Balance: {{ $wallet_balance }}</div>
                </div>
                @include('_partials.table')
            </div>
        </div>
    </div>
</section>
<!--End Contact Form & Info-->

@endsection