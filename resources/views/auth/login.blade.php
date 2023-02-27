@extends('layouts.auth')

@section('content')
<div class="container-fluid px-0">
    <div class="row  align-items-start">
        <div class="col-xl-5  col-lg-4 ">

            <div class="header p-5">
                <a class="d-flex nounderline align-items-center" href="/">
                    <span class="material-symbols-outlined ">keyboard_backspace</span>
                    <span>Back</span>
                </a>
            </div>

            <div class="content p-5">
                <div class="logo ">
                    <a class="px-5" href="/">
                        <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
                    </a>
                </div>

                <div class="row mb-4" id="title">
                    <h1 class="sign-in" id="at_lnk_sign_in_home_one">
                        WELCOME BACK
                    </h1>
                    <div class="row " id="signInMessage">
                        <span class="sign-in-prompt" data-testid="sign-in-message">
                            Sign in to save your vehicles, track your orders.
                            .</span>
                    </div>
                </div>


                <login :redirect="true"></login>

                <div class="text-center mt-3">
                    Dont have an account yet? <a href="/register" class="color--primary bold">Create One</a>
                </div>

            </div>



        </div>

        <div class="d-none d-lg-block d-md-block d-xl-block col-12  col-md-7  position-relative bg-gradient-primary px-7 border-radius-lg">
            <div class="image-content">
                <img src="/images/utils/sign.jpeg" alt="Avatar" class="image  h-100 ">
            </div>



        </div>

    </div>
</div>
@endsection