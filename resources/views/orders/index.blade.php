@extends('layouts.app')

@section('content')

<div class="bg-light">
    <div class="container">
        <div class="d-block d-sm-none">
            @include('_partials.mobile_nav')
        </div>
    </div>
    <div class="container ">
        <div class="row">
            @include('_partials.nav')
            <div class="col-md-9 mt-5">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="page-title ">Orders History</h2>
                    <div class="wallet-balance"></div>
                </div>
                <general-table class="bg-white" />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

@endsection