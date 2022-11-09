@extends('layouts.app')
 
@section('content')
<section class="sec-padding--account bg--gray">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    @include('account.nav')
                </div>
                <div class="col-md-7">
                    <h2 class="page-title">Address </h2>
                    <div class="card card-plain">
                        <div id="stored_address"  class="card-body">
                            <div id="full-bg"  class="position-relative">
                                <div class="signup--middle">
                                    <div class="loading">
                                        <div class="loader"></div>
                                    </div>
                                    <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="The Luxury sale Logo">
                                </div>        
                            </div>
      
                           <addresses   />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Contact Form & Info-->
@endsection