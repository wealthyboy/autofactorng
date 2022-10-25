@extends('layouts.app')
 
@section('content')
<section class="sec-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('account.nav')
            </div>
            <div class="col-md-9">
                <h2 class="page-title">Returns</h2>

                <div class="card card-plain">
                    <div class="card-body">
                        <p>No Returns</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!--End Contact Form & Info-->

@endsection