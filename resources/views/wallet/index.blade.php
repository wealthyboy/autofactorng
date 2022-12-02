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
                <wallet-table :auto_credit="false" :price_range="{{ collect([1000, 9000000]) }}" :user="{{ $user }}" />
            </div>
        </div>
    </div>
</section>
<!--End Contact Form & Info-->

@endsection