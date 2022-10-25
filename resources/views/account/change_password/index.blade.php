@extends('layouts.app')
 
@section('content')
   
<div class="sec-padding--account bg--gray">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('account.nav')
            </div>
            <div class="col-md-7">
                <h2 class="">Change Password</h2>
                <div class="card card-plain">
                   <div id="stored_address"  class="card-body">
                       <change-password />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Contact Form & Info-->

@endsection