@extends('layouts.app')

@section('content')

<div class="bg-light">

    @include('_partials.mobile_nav')

    <div class="container ">
        <div class="row ">
            @include('_partials.nav')
            <div class="col-md-9  mt-5">
                <wallet-table :auto_credit="false" :price_range="{{ collect([1000, 9000000]) }}" :user="{{ $user }}" />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

@endsection