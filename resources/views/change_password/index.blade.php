@extends('layouts.app')

@section('content')

<div class="bg-light">
    @include('_partials.mobile_nav')
    <div class="container">
        <div class="row">
            @include('_partials.nav')
            <div class="col-md-5  mt-5">
                <h3 class="page-title ">Change Password</h3>
                <change-password :user="{{ $user }}" />
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

@endsection