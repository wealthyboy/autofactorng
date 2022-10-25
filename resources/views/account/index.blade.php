@extends('layouts.app')
 
@section('content')
   
<div class="sec-padding--account bg--gray">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('account.nav')
            </div>
            <div class="col-md-7">
                <h2 class=" ">Account</h2>

                <div class="card card-plain">
                    <div class="card-body">
                       <form method="POST" action="">
                           @include('errors.errors')
                            <h2></h2>
                            @csrf
                             <p class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->name }}" required autofocus>
                            </p>
                            <p class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{  $user->last_name }}" required autofocus>
                            </p>
                            <p class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{  $user->phone_number }}" required autofocus>
                            </p>
                            <p class="form-group text-right">
                                <button type="submit" class="btn btn--lg bold btn--primary" name="register" value="Log in">Submit</button>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>
<!--End Contact Form & Info-->

@endsection