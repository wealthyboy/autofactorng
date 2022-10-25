@extends('layouts.app')
 
@section('content')
<section class="sec-padding">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                @include('account.nav')
            </div>
            <div class="col-md-9">
                <h2 class="page-title">Create Address</h2>

                <div class="card card-plain">
                    <div class="card-body">
                       <form method="POST"  id="address-from" action="/address/create">
                           @include('errors.errors')

                            <h2></h2>
                            @csrf

                             <p class="form-field-wrapper">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="input--lg form-full" name="first_name" value="{{ old('first_name') }}" required autofocus>

                            </p>
                             <p class="form-field-wrapper">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="input--lg form-full" name="last_name" value="{{ old('last_name') }}" required autofocus>
                            </p>
                          
                             <p class="form-field-wrapper">
                                <label for="address-input">Address</label>
                                <input id="address-input" type="text" class="input--lg form-full map-input" name="address" value="{{ old('address') }}" required autofocus>
                            </p>

                             <p class="form-field-wrapper">
                                <label for="address">Address 2</label>
                                <input id="address" type="text" class="input--lg form-full" name="address2" value="{{ old('address2') }}"  autofocus>
                            </p>

                             <p class="form-field-wrapper">
                                <label for="city">City</label>
                                <input id="city" type="text" class="input--lg form-full" name="city" value="{{ old('city') }}"  required autofocus>
                            </p>

                            <p class="form-field-wrapper">
                                <label for="zip">Zip</label>
                                <input id="zip" type="text" class="input--lg form-full" name="zip" value="{{ old('zip') }}"  autofocus>
                            </p>

                          
                            <p class="form-field-wrapper">
                                <label for="state">State</label>
                                <input id="state" type="text" class="input--lg form-full" name="state"  value="{{ old('state') }}"  required autofocus>
                            </p>
                            <p class="form-field-wrapper lost_password">
                                <button type="submit" class="btn btn--lg btn--primary" name="register" value="Submit">Submit</button>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </div>
    </div>
</section>
<!--End Contact Form & Info-->

@endsection