<?php $__env->startSection('content'); ?>
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


                <div class="row mb-5" id="signInMessage">
                    <span class="sign-in-prompt" data-testid="sign-in-message">
                        Welcome to AutoFactor
                        .</span>
                </div>
                <register></register>



                <div class="text-center mt-3">
                    Already have an account ? <a href="/login" class="color--primary bold">Create One</a>
                </div>

            </div>



        </div>
        <div class="position-relative  d-none d-lg-block d-md-block d-xl-block col-12  col-md-7  position-relative bg-gradient-primary h-100  px-7 border-radius-lg" style="background-image: url(&quot;/images/utils/register_autofactorng.jpeg&quot;); background-size: cover; background-repeat: no-repeat; height: 100vh !important; background-position: center center;     background-position: -450px 0px;">
            <div class="image-overlay d-flex align-items-center">
                <div class="text text-white ">
                    <div>
                        At Autofactor, we have an extensive inventory of over 50,000 items to cater to your needs, whether online or at our physical store. Also, you'll have access to a range of exclusive benefits and incentives that are designed to make your shopping experience even better.
                        Sign up today to enjoy this and get even more great benefits.
                    </div>
                    <h1 class="text-white mb-4 me-3"> MEMBER BENEFITS: </h1>
                    <ul>
                        <li class="right-side-bullets">
                            <div class="right-content-icons"><img class="right-content-svgs" alt="" src="/images/rewards.svg"></div>
                            <div class="bullet-text"> Earn a $20 Reward after every 5 purchases of $20 or more </div>
                        </li>
                        <li class="right-side-bullets">
                            <div class="right-content-icons"><img class="right-content-svgs" alt="" src="/images/vehicle/orange_1.svg"></div>
                            <div class="bullet-text"> Save your vehicles, track your service history and access thousands of repair guides, all for free </div>
                        </li>
                        <li class="right-side-bullets">
                            <div class="right-content-icons"><img class="right-content-svgs" alt="" src="/images/orangeStar.svg"></div>
                            <div class="bullet-text"> Get exclusive deals and offers, customized for you </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/auth/register.blade.php ENDPATH**/ ?>