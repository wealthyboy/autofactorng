@extends('layouts.app')

@section('content')

<div class="bg-light">
    @include('_partials.mobile_nav')
    <div class="container">
        <div class="row">
            @include('_partials.nav')
            <div class="col-md-6  mt-5">
                <h3 class="page-t">Address</h3>
                <ship-addresses />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & f-->

@endsection