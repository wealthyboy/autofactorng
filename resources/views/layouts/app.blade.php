<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Autofactor</title>

   <meta name="keywords" content="" />
   <meta name="description" content="PAutofactor">
   <meta name="author" content="SW-THEMES">

   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

   <!-- Favicon -->
   <!-- <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png"> -->
   <!-- Main CSS File -->
   <link rel="stylesheet" type="text/css" href="/vendor/fontawesome-free/css/all.min.css">

   <link rel="stylesheet" href="/css/app.css">
</head>

<script>
   Window.user = {
      user: {
         '{!! $user !!}'
      },
      settings: {
         '{!! $system_settings !!}'
      },
      token: '{!! csrf_token() !!}'
   }
</script>

<body>
   <div id="app" class="page-wrapper">


      <header class="header">

         <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
            <div class="container">
               <div class="header-left col-lg-2 w-auto pl-0">
                  <button class="mobile-menu-toggler text-primary mr-2" type="button">
                     <i class="fas fa-bars"></i>
                  </button>
                  <a href="/" class="logo">
                     <img src="https://autofactor.ng/images/logo/autofactor_logo.png" alt="Autofactor  Logo">
                  </a>
               </div>

               <div class="header-right w-lg-max">
                  <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                     <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                  </div>


                  @auth
                  <a href="/account" class="header-icon" title="login">
                     <img src="/images/utils/signin.svg" alt="">
                     <div class="text-sm">Account</div>
                  </a>
                  @endauth

                  @guest
                  <a href="/login" class="header-icon" title="login">
                     <img src="/images/utils/signin.svg" alt="">
                     <div class="text-sm">Signin</div>
                  </a>
                  @endguest


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

         <div class="header-bottom sticky-header " data-sticky-options="{'mobile': false}">
            <div class="a-main-nav w-100">
               <div class="row g-0  d-flex ">
                  <div class=" nav-container  d-flex justify-content-center align-items-center pb-1">
                     <div class="col-md-1">
                        <div class="menu">
                           <button data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="nav-btn menu-nav-btn mb-0 pb-0" role="button">
                              <span class="menu-open">
                                 <img data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/hamburger.svg" alt="" srcset="">
                                 <div class="">Menu</div>
                              </span>

                              <span class="menu-close d-none">
                                 <img data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" alt="" srcset="">
                                 <div class="text-xs">Close</div>
                              </span>

                           </button>
                        </div>
                     </div>

                     <div class="col-md-2">
                        <div class="text">
                           <button class="nav-btn  w-100 mb-0">
                              <div class="d-flex add-a-vehicle justify-content-evenly">
                                 <div>
                                    <img src="/images/utils/vehicle-new.svg" alt="">
                                 </div>
                                 <div>Add vehicle</div>
                                 <div>
                                    <img src="/images/utils/header-arrow.svg" alt="">
                                 </div>
                              </div>
                           </button>
                        </div>
                     </div>

                     <div class="col-md-7">
                        <!-- <button class="btn bg-white mb-0" type="button" id="button-addon1">
                              <i class="bi bi-search"></i>
                           </button> -->
                        <input type="text" class="w-100 search-input bg-white" placeholder="Find parts and products" aria-label="Example text with button addon" aria-describedby="button-addon1">
                     </div>

                     <div class="col-md-2">
                        <div class="text">
                           <a href="#" class="nav-btn  w-100 mb-0">
                              <div class="d-flex add-a-vehicle justify-content-evenly">
                                 <div class="ml-3">
                                    <i class="bi bi-camera-reels-fill"></i>
                                 </div>
                                 <div>How to</div>
                                 <div class="me-2">
                                    <img src="/images/utils/header-arrow.svg" alt="">
                                 </div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>

               @include('_partials.nav_categories')
            </div>
            <!-- End .container -->
         </div>
         <!-- End .header-bottom -->
      </header>
      <!-- End .header -->

      <main class="main">
         @yield('content')
      </main>

      <!-- End .main -->

      <footer class="footer bg-dark">
         <div class="footer-middle">
            <!-- -------   END PRE-FOOTER 4 - title & description and input    -------- -->
            <div class="container">
               <div class="footer-middle ">
                  @include('layouts.footer.mobile_footer')

                  <div class=" d-none d-lg-block d-md-block d-xl-block">
                     @include('layouts.footer.desktop_footer')
                  </div>
               </div><!-- End .footer-middle -->

               <div class="mobile-footer text-center  d-block d-sm-none">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap">
                     <a href="#" class="bi bi-facebook fa-2x text-white mr-2" target="_blank" title="Facebook"></a>
                     <a href="#" class="bi bi-twitter  fa-2x text-white" target="_blank" title="Twitter"></a>
                     <a href="#" class="bi bi-instagram  fa-2x text-white" target="_blank" title="Linkedin"></a>
                  </div><!-- End .footer-bottom -->
                  <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                  @if ( auth()->check() && auth()->user()->isAdmin() )
                  <p class="footer-copyright mx-3"><a target="_blank" href="/admin">Go to Admin</a></p>
                  @endif
               </div>

               <div class="d-none d-lg-block d-md-block d-xl-block">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap  ">
                     <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                     <div class="social-icons py-3">
                        <a href="#" class="bi bi-facebook text-white  me-4 fa-2x" target="_blank" title="Facebook"></a>
                        <a href="#" class="bi bi-twitter  text-white me-4 fa-2x" target="_blank" title="Twitter"></a>
                        <a href="#" class="bi bi-instagram  text-white me-4 fa-2x" target="_blank" title="Linkedin"></a>
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
         <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
         <nav class="mobile-nav">
            <ul class="mobile-menu">
               <li><a href="">Home</a></li>
               <li>
                  <a href="category.html">Categories</a>
                  <ul>
                     <li><a href="category.html">Full Width Banner</a></li>
                     <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                     <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>

                  </ul>
               </li>
               <li>
                  <a href="product.html">Products</a>
                  <ul>
                     <li>
                        <a href="#" class="nolink">PRODUCT PAGES</a>
                        <ul>
                           <li><a href="product.html">SIMPLE PRODUCT</a></li>

                        </ul>
                     </li>
                     <li>
                        <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                        <ul>
                           <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>

                        </ul>
                     </li>
                  </ul>
               </li>
               <li>
                  <a href="#">Pages<span class="tip tip-hot">Hot!</span></a>
                  <ul>
                     <li>
                        <a href="wishlist.html">Wishlist</a>
                     </li>
                     <li>
                        <a href="cart.html">Shopping Cart</a>
                     </li>
                     <li>
                        <a href="checkout.html">Checkout</a>
                     </li>
                     <li>
                        <a href="dashboard.html">Dashboard</a>
                     </li>
                     <li>
                        <a href="login.html">Login</a>
                     </li>
                     <li>
                        <a href="forgot-password.html">Forgot Password</a>
                     </li>
                  </ul>
               </li>
               <li><a href="blog.html">Blog</a></li>
               <li><a href="#">Elements</a>
                  <ul class="custom-scrollbar">
                     <li><a href="element-accordions.html">Accordion</a></li>

                  </ul>
               </li>
            </ul>

            <ul class="mobile-menu mt-2 mb-2">
               <li class="border-0">
                  <a href="#">
                     Special Offer!
                  </a>
               </li>
               <li class="border-0">
                  <a href="#" target="_blank">
                     Buy Autofactorng!
                     <span class="tip tip-hot">Hot</span>
                  </a>
               </li>
            </ul>

            <ul class="mobile-menu">
               <li><a href="login.html">My Account</a></li>
               <li><a href="contact.html">Contact Us</a></li>
               <li><a href="blog.html">Blog</a></li>
               <li><a href="wishlist.html">My Wishlist</a></li>
               <li><a href="cart.html">Cart</a></li>
               <li><a href="login.html" class="login-link">Log In</a></li>
            </ul>
         </nav>
         <!-- End .mobile-nav -->

         <form class="search-wrapper mb-2" action="#">
            <input type="text" class="form-control mb-0" placeholder="Search..." required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
         </form>

         <div class="social-icons">
            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
            </a>
            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
            </a>
            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
            </a>
         </div>
      </div>
      <!-- End .mobile-menu-wrapper -->
   </div>
   <!-- End .mobile-menu-container -->

   <div class="sticky-navbar">
      <div class="sticky-info">
         <a href="">
            <i class="icon-home"></i>Home
         </a>
      </div>
      <div class="sticky-info">
         <a href="category.html" class="">
            <i class="icon-bars"></i>Categories
         </a>
      </div>
      <div class="sticky-info">
         <a href="wishlist.html" class="">
            <i class="icon-wishlist-2"></i>Wishlist
         </a>
      </div>
      <div class="sticky-info">
         <a href="login.html" class="">
            <i class="icon-user-2"></i>Account
         </a>
      </div>
      <div class="sticky-info">
         <a href="cart.html" class="">
            <i class="icon-shopping-cart position-relative">
               <span class="cart-count badge-circle">3</span>
            </i>Cart
         </a>
      </div>
   </div>

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

</body>

</html>