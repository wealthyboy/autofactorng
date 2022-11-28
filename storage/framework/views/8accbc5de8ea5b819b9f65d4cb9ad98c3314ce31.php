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



            <?php if($user && $user->hasActiveSubscription()): ?>
            <div class="row mb-5" id="signInMessage">
               <span class="sign-in-prompt" data-testid="sign-in-message">Ypu already Subscribed</span>
               <div><a href="/">Continue</a></div>
            </div>

            <?php endif; ?>



            <?php if($user && !$user->hasActiveSubscription()): ?>
            <div class="row mb-5" id="signInMessage">
               <span class="sign-in-prompt" data-testid="sign-in-message">Fund Your Wallet To Get Auto Credits.</span>
               <div><a href="/">Continue</a></div>
            </div>
            <wallet></wallet>

            <?php endif; ?>


            <?php if(auth()->guard()->guest()): ?>
            <div class="row mb-5" id="signInMessage">
               <span class="sign-in-prompt" data-testid="sign-in-message">Welcome.</span>
            </div>
            <subscribe :price_range="<?php echo e(collect($price_range)); ?>"></subscribe>
            <?php endif; ?>


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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/subscribe/index.blade.php ENDPATH**/ ?>