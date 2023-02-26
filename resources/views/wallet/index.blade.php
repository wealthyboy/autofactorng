@extends('layouts.app')

@section('content')

<div class="bg-light">

    @include('_partials.mobile_nav')

    <div class="container ">
        <div class="row mt-5">
            @include('_partials.nav')
            <div class="col-md-9 ">
                <wallet-table :auto_credit="false" :price_range="{{ collect([1000, 9000000]) }}" :user="{{ $user }}" />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

@endsection