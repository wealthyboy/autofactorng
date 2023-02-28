<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Autofactor</title>

   <meta name="keywords" content="" />
   <meta name="description" content="Autofactor">
   <meta name="author" content="">

   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

   <!-- Favicon -->
   <!-- <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png"> -->
   <!-- Main CSS File -->

   <link rel="stylesheet" href="/css/app.css">


</head>


<body>
   <div id="app" class="page-wrapper">


      <header class="header ">
         <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
            <div class="container-fluid">
               <div class="header-left col-lg-2 w-auto pl-0">
                  <button class="mobile-menu-toggler text-primary mr-2" type="button">
                     <i class="fas fa-bars"></i>
                     <div class="mt-3">Menu</div>
                  </button>
                  <a href="/" class="logo">
                     <img src="https://autofactor.ng/images/logo/autofactor_logo.png" alt="Autofactor  Logo">
                  </a>
               </div>
               <!-- End .header-left -->

               <div class="header-right w-lg-max">
                  <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0"></div>
                  <!-- End .header-search -->

                  <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                     <img alt="phone" src="/assets/images/phone.png" width="30" height="30" class="pb-1">
                     <h6><span>Call us now</span><a href="tel:#" class="text-dark font1">+123 5678 890</a></h6>
                  </div>
                  <?php if(auth()->guard()->check()): ?>
                  <div class="position-relative me-5">
                     <a href="/account" class="header-" title="account">
                        <img src="/images/utils/signin.svg" class="ms-2" alt="">
                     </a>
                     <div class="text-sm">Account</div>
                  </div>

                  <?php endif; ?>

                  <?php if(auth()->guard()->guest()): ?>
                  <div class="position-relative me-5 ">

                     <a href="/login" class="header-" title="login">
                        <img src="/images/utils/signin.svg" class="ms-2" alt="">
                     </a>
                     <div class="text-sm">Sign in</div>

                  </div>
                  <?php endif; ?>


                  <div class="dropdown cart-dropdown">
                     <cart-side-bar></cart-side-bar>
                  </div>
                  <!-- End .dropdown -->
               </div>
               <!-- End .header-right -->
            </div>
            <!-- End .container -->
         </div>
         <!-- End .header-middle -->
         <?php echo $__env->make('_partials.nav_categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
            <div class="container-fluid">
               <nav class="main-nav w-100 ">
                  <div class="d-flex align-items-center">
                     <div class="menu-icon">

                        <button data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="nav-btn menu-nav-btn mb-0 pb-0 border-0" role="button">
                           <span class="menu-open">
                              <img data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/hamburger.svg" alt="" class="ms-1" srcset="">
                              <div class="">Menu</div>
                           </span>

                           <span class="menu-close d-none">
                              <img data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" class="ms-2" alt="" srcset="">
                              <div class="text-xs">Close</div>
                           </span>

                        </button>
                     </div>

                     <div class="menu-i   menu-i  w-25 ms-5">
                        <add-vehicle></add-vehicle>
                     </div>


                     <product-search class="mx-5"></product-search>

                     <div class="menu-i menu-i  w-25 me-5">
                        <a href="" role="button" class="w-100 mb-0 border-0">
                           <div class="d-flex add-a-vehicle justify-content-evenly align-content-center">
                              <div class="align-self-center">How To</div>
                              <div class="align-self-center"><img src="/images/utils/header-arrow.svg" alt=""></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </nav>
            </div>
            <!-- End .container -->
         </div>
         <!-- End .header-bottom -->
         <div class="container-fluid  d-sm-block d-lg-none">
            <product-search></product-search>
         </div>





         <div class="container-fluid  d-sm-block d-lg-none">

            <div class="d-flex w-100">
               <div class="menu-i w-50 me-1">

                  <button class="nav-btn  w-100 mb-0">
                     <div class="d-flex add-a-vehicle justify-content-evenly">
                        <div><img src="/images/utils/vehicle-new.svg" alt=""></div>
                        <div>Add vehicle</div>
                        <div><img src="/images/utils/header-arrow.svg" alt=""></div>
                     </div>
                  </button>
               </div>


               <div class="menu-i w-50">
                  <a href="/how-to" role="button" class="w-100 mb-0 ">
                     <div class="d-flex add-a-vehicle justify-content-evenly align-content-center">
                        <div class="align-self-center">How To</div>
                        <div class="align-self-center"><img src="/images/utils/header-arrow.svg" alt=""></div>
                     </div>
                  </a>
               </div>
            </div>
         </div>

      </header>

      <make-message></make-message>



      <!-- End .header -->
      <div class="coverlay overlay-close"></div>

      <main class="main">
         <?php echo $__env->yieldContent('content'); ?>
         <modal-search></modal-search>
      </main>


      <!-- End .main -->


      <footer class="footer bg-dark">
         <div class="footer-middle">
            <!-- -------   END PRE-FOOTER 4 - title & description and input    -------- -->
            <div class="container">
               <div class="footer-middle ">
                  <?php echo $__env->make('layouts.footer.mobile_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <div class=" d-none d-lg-block d-md-block d-xl-block">
                     <?php echo $__env->make('layouts.footer.desktop_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
               </div><!-- End .footer-middle -->

               <div class="mobile-footer text-center  d-block d-sm-none">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap">
                     <a href="#" class="bi bi-facebook fa-2x text-white mr-2" target="_blank" title="Facebook"></a>
                     <a href="#" class="bi bi-twitter  fa-2x text-white" target="_blank" title="Twitter"></a>
                     <a href="#" class="bi bi-instagram  fa-2x text-white" target="_blank" title="Linkedin"></a>
                  </div><!-- End .footer-bottom -->
                  <p class="footer-copyright py-3 pr-4 mb-0">© <?php echo e(config('app.name')); ?>. <?php echo e(date('Y')); ?>. All Rights Reserved</p>


               </div>

               <div class="d-none d-lg-block d-md-block d-xl-block">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap  ">
                     <p class="footer-copyright py-3 pr-4 mb-0">© <?php echo e(config('app.name')); ?>. <?php echo e(date('Y')); ?>. All Rights Reserved</p>
                     <?php if( auth()->check() && auth()->user()->isAdmin() ): ?>
                     <p class="footer-copyright mx-3 text-white"><a target="_blank" href="/admin">Go to Admin</a></p>
                     <?php endif; ?>
                     <div class="social-icons py-3">
                        <a href="#" class="bi bi-facebook text-white  me-5 fa-2x" target="_blank" title="Facebook"></a>
                        <a href="#" class="bi bi-twitter  text-white me-5 fa-2x" target="_blank" title="Twitter"></a>
                        <a href="#" class="bi bi-instagram  text-white  fa-2x" target="_blank" title="Linkedin"></a>
                     </div><!-- End .social-icons -->
                  </div><!-- End .footer-bottom -->
               </div>

            </div><!-- End .container -->
         </div>
         <!-- End .footer-middle -->

         <div class="container">

         </div>
         <!-- End .container -->
      </footer>
      <!-- End .footer -->
   </div>
   <!-- End .page-wrapper -->



   <div class="mobile-menu-overlay"></div>
   <!-- End .mobil-menu-overlay -->

   <div class="mobile-menu-container">
      <div class="mobile-menu-wrapper">
         <div class="d-flex border-bottom justify-content-between p-4">
            <div class="menu">Menu</div>
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
         </div>
         <nav class="mobile-nav">
            <div class="d-flex  border-bottom   px-4  justify-content-between">
               <?php if(auth()->guard()->check()): ?>
               <a href="/account" class="header-icon  d-flex" title="account">
                  <img src="/images/utils/signin.svg" alt="">
                  <span class="text-sm ml-2">Account</span>
               </a>
               <?php endif; ?>
               <?php if(auth()->guard()->guest()): ?>

               <a href="/account" class="header-icon  d-flex" title="account">
                  <img src="/images/utils/signin.svg" alt="">
                  <span class="text-sm">Signin</span>
               </a>
               <?php endif; ?>
               <div class="menu">Wallet</div>
            </div>

            <ul class="mobile-menu mt-3">
               <?php $__currentLoopData = $global_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                  <a class="py-4" href="<?php echo e($category->link ? $category->link : '/products/'.$category->slug); ?>"><?php echo e($category->name); ?></a>
                  <?php if($category->isCategoryHaveMultipleChildren()): ?>
                  <ul>
                     <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <li>
                        <a href="/products/<?php echo e($children->slug); ?>" class="category-heading"><?php echo e($children->name); ?> </a>
                        <?php if($children->children->count()): ?>
                        <ul>
                           <?php $__currentLoopData = $children->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <li><a href="/products/<?php echo e($children->slug); ?>"><?php echo e($children->name); ?></a></li>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                     </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <?php elseif( !$category->isCategoryHaveMultipleChildren() && $category->children->count() ): ?>
                  <ul>
                     <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li><a class="category-heading" href="/products/<?php echo e($children->slug); ?>"><?php echo e($children->name); ?></a></li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <?php endif; ?>
               </li>

               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>



         </nav>
         <!-- End .mobile-nav -->

      </div>
      <!-- End .mobile-menu-wrapper -->
   </div>
   <!-- End .mobile-menu-container -->



   <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url('assets/images/newsletter_popup_bg.jpg')">
      <div class="newsletter-popup-content">
         <img src="assets/images/logo.png" width="111" height="44" alt="Logo" class="logo-newsletter">
         <h2>Subscribe to newsletter</h2>

         <p>
            Subscribe to the Autofactorng mailing list to receive updates on new arrivals, special offers and our promotions.
         </p>

         <form action="#">
            <div class="input-group">
               <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Your email address" required />
               <input type="submit" class="btn btn-primary" value="Submit" />
            </div>
         </form>
         <div class="newsletter-subscribe">
            <div class="custom-control custom-checkbox">
               <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
               <label for="show-again" class="custom-control-label">
                  Don't show this popup again
               </label>
            </div>
         </div>
      </div>
      <!-- End .newsletter-popup-content -->

      <button title="Close (Esc)" type="button" class="mfp-close">
         ×
      </button>
   </div>
   <!-- End .newsletter-popup -->

   <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

   <!-- Plugins JS File -->
   <script src="/js/jquery.min.js"></script>
   <script src="/js/app.js"></script>


   <?php echo $__env->yieldContent('page-scripts'); ?>
   <script type="text/javascript">
      <?php echo $__env->yieldContent('inline-scripts'); ?>

      $(".menu-nav-btn, .panel-close").on("click", function() {
         let open = $(".menu-open");
         let close = $(".menu-close");
         if (open.hasClass("d-none")) {

            open.removeClass("d-none");
            close.addClass("d-none");

            $(".coverlay").removeClass("d-block").addClass("d-none");
            $('html, body').css({
               overflow: 'auto',
               height: 'auto'
            });

         } else {
            open.addClass("d-none");
            close.removeClass("d-none");
            $(".coverlay").removeClass("d-none").addClass("d-block");
            $('html, body').css({
               overflow: 'hidden',
               height: '100%'
            });

         }

      });

      $(".overlay-close").on('click', function() {
         let close = $(".menu-close");
         close.click()
         $(".coverlay").removeClass("d-block").addClass("d-none");
      })
   </script>

</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/layouts/app.blade.php ENDPATH**/ ?>