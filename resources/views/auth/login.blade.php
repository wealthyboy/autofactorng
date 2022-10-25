@extends('layouts.auth')

@section('content')
<div class="container-fluid px-0">
    <div class="row">
        <div class="col-xl-5  col-lg-4 ">

            <div class="header p-5">
                <a class="d-flex nounderline align-items-center" href="">
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
                </div>

                <div class="row mb-5" id="signInMessage">
                    <span class="sign-in-prompt" data-testid="sign-in-message">
                        Sign in to save your vehicles, track your orders.
                        .</span>
                </div>
                <login></login>



                <div class="text-center mt-3">
                    Dont have an account yet? <a href="/register" class="color--primary bold">Create One</a>
                </div>

            </div>



        </div>
        <div style="background-image: url('/images/utils/sign-in-background-img.jpeg'); background-size: cover; height: 100vh !important;" class="col-12  col-md-7  position-relative bg-gradient-primary h-100  px-7 border-radius-lg d-flex flex-column justify-content-center">
            <h1 class="text-white mb-4"> MEMBER BENEFITS: </h1>
            <ul>
                <li class="right-side-bullets">
                    <div class="right-content-icons">
                        <img class="right-content-svgs" alt="" src="/images/rewards.svg">
                    </div>
                    <div class="bullet-text">
                        Earn a $20 Reward after every 5 purchases of $20 or more
                    </div>
                </li>
                <li class="right-side-bullets">
                    <div class="right-content-icons">
                        <img class="right-content-svgs" alt="" src="/images/vehicle/orange_1.svg">
                    </div>
                    <div class="bullet-text">
                        Save your vehicles, track your service history and access thousands of repair guides, all for free
                    </div>
                </li>
                <li class="right-side-bullets">
                    <div class="right-content-icons">
                        <img class="right-content-svgs" alt="" src="/images/orangeStar.svg">
                    </div>
                    <div class="bullet-text">
                        Get exclusive deals and offers, customized for you
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection