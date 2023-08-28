@extends('layouts.app')
 
@section('content')
  
   <!--Content-->
   <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"><small>WishList</small></li>
            </ol>
        </div>
    </nav> 
    <section class="bg--gray">          
        <div class="container-fluid">
            <div id="js-loading"  class="full-bg">
                <div class="signup--middle">
                    <div class="loading">
                        <div class="loader"></div>
                    </div>
                    <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="The Luxury sale Logo">
                </div>        
            </div>
            <favorite-index  />
        </div>
    </section>
    <!--End Content-->
@endsection



