@extends('layouts.checkout')
 
@section('content')
<section class="bg--gray">
    <div id="full-bg"  class="full-bg">
        <div class="signup--middle">
            <div class="loading">
                <div class="loader"></div>
            </div>
            <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="{{ Config('app.name') }}  Logo">
        </div>        
    </div>
    <checkout-index  :csrf="{{ $csrf }}" />
</section>
@endsection



