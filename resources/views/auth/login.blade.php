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



        <div class="position-relative  d-none d-lg-block d-md-block d-xl-block col-12  col-md-7  position-relative bg-gradient-primary h-100  px-7 border-radius-lg" style="background-image: url(&quot;/images/utils/sign.jpeg&quot;); background-size: cover; background-repeat: no-repeat; height: 100vh !important; background-position: center center;     background-position: -450px 0px;">

            <div class="image-overlay d-flex align-items-center">

                <div class="text text-white ">
                    <div class=" ">
                        At Autofactor, we have an extensive inventory of over 50,000 items to cater to your needs, whether online or at our physical store. Also, you'll have access to a range of exclusive benefits and incentives that are designed to make your shopping experience even better.
                        Sign up today to enjoy this and get even more great benefits.
                    </div>

                    <h1 class="text-white mb-4"> MEMBER BENEFITS: </h1>
                    <ul>
                        <li class="d-flex">
                            <div class="right-content-icons">

                                <i class="material-symbols-outlined">
                                    payments
                                </i>

                            </div>
                            <div class="bullet-text">Discounts and offers: Receive exclusive discounts on auto parts and accessories. </div>

                        </li>
                        <li class="d-flex">
                            <div class="right-content-icons">
                                <span class="material-symbols-outlined fx-2">
                                    login
                                </span>
                            </div>
                            <div class="bullet-text"> Priority access: You'll be the first to know about new products, limited-time offers, and other special promotions.</div>
                        </li>
                        <li class="d-flex">
                            <div class="right-content-icons">
                                <span class="material-symbols-outlined">
                                    recommend
                                </span>
                            </div>
                            <div class="bullet-text"> Personalized product recommendations based on your previous purchases and preferences.</div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>



    </div>
</div>
@endsection