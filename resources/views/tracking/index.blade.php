@extends('layouts.app')

@section('content')

<section class="my-5">

    @include('_partials.mobile_nav')

    <div class="container">
        <div class="row">
            @include('_partials.nav')
            <div class="col-md-5">
                <h2>Track your order</h2>

                <track-orders />

            </div>
        </div>
    </div>

</section>
<!--End Contact Form & Info-->

@endsection