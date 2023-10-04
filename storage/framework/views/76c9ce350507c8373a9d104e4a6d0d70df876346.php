<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">
    <div class="row  align-items-start">
        <div class="col-xl-5 col-lg-5 col-md-12 col-12">

            <?php echo $__env->make('_partials.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


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
                            Sign In to Track Your Orders & Enjoy Personalized Experience.
                            .</span>
                    </div>
                </div>


                <login :redirect="true"></login>

                <div class="text-center mt-3">
                    Dont have an account yet? <a href="/register" class="color--primary bold">Create One</a>
                </div>

            </div>

        </div>



        <div class="position-relative  d-none d-lg-block  d-xl-block col-7  col-md-7  position-relative bg-gradient-primary h-100  px-7 border-radius-lg" style="background-image: url(&quot;/images/utils/sign.jpeg&quot;); background-size: cover; background-repeat: no-repeat; height: 100vh !important; background-position: center center;     background-position: -396px 0px;">

            <div class="image-overlay d-flex align-items-center">

                <div class="text text-white ">
                    <div class="d-flex align-items-center flex-column me-5">
                        <div class="fs-4 mb-5 w-75">
                            At Autofactor, we have an extensive inventory of over 50,000 items to cater to your needs, whether online or at our physical store. Also, you'll have access to a range of exclusive benefits and incentives that are designed to make your shopping experience even better.
                            Sign up today to enjoy this and get even more great benefits.
                        </div>
                        <div class="member-heading">
                            <h1 class="text-white ms-5 display-3 "> MEMBER BENEFITS: </h1>
                        </div>
                    </div>


                    <ul>
                        <li class="d-flex align-items-center justify-content-center mb-5">
                            <div class="right-content-icons ">

                                <i class="material-symbols-outlined display-1">
                                    payments
                                </i>

                            </div>
                            <div class="bullet-text w-50 ms-4 fs-4">Discounts and offers: Receive exclusive discounts on auto parts and accessories. </div>

                        </li>
                        <li class="d-flex align-items-center justify-content-center mb-5">
                            <div class="right-content-icons">
                                <span class="material-symbols-outlined display-1">
                                    login
                                </span>
                            </div>
                            <div class="bullet-text w-50 ms-4 fs-4"> Priority access: You'll be the first to know about new products, limited-time offers, and other special promotions.</div>
                        </li>
                        <li class="d-flex align-items-center justify-content-center">
                            <div class="right-content-icons">
                                <span class="material-symbols-outlined display-1">
                                    recommend
                                </span>
                            </div>
                            <div class="bullet-text w-50 ms-4 fs-4"> Personalized product recommendations based on your previous purchases and preferences.</div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>



    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/auth/login.blade.php ENDPATH**/ ?>