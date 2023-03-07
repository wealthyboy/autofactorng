<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
                  <button class="mobile-menu-toggler  mr-2" type="button">
                     <i class="fas fa-bars"></i>
                     <span class="mt-3 fs-5">Menu</span>
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
                     <h6><span>Call to order</span><a href="tel:#" class="text-dark font1">{{optional($system_settings)->store_phone }}</a></h6>
                  </div>
                  @auth
                  <div class="position-relative me-5">
                     <a href="/account" class="d-flex flex-column align-items-center" title="account">
                        <span class="material-symbols-outlined display-5">
                           person
                        </span>
                        <span class="header-right-icons">
                           Account
                        </span>
                     </a>
                  </div>

                  @endauth

                  @guest
                  <div class="position-relative me-5 ">
                     <a href="/login" class="d-flex flex-column align-items-center" title="account">
                        <span class="material-symbols-outlined display-5">
                           person
                        </span>
                        <span class="header-right-icons">
                           Sign In
                        </span>
                     </a>

                  </div>
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
         @include('_partials.nav_categories')

         <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
            <div class="container-fluid">
               <nav class="main-nav w-100 ">
                  <div class="d-flex align-items-center">
                     <div class="menu-icon">

                        <a data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="nav-btn menu-nav-btn mb-0 pb-0 border-0" role="button">
                           <span class="menu-open d-flex flex-column align-items-center">
                              <img data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/hamburger.svg" alt="" class="ms-1" srcset="">
                              <div class="">Menu</div>
                           </span>

                           <span class="menu-close d-none d-flex flex-column align-items-center">
                              <img data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" class="ms-2" alt="" srcset="">
                              <div class="text-xs">Close</div>
                           </span>

                        </a>
                     </div>

                     <div class="menu-i   menu-i  w-25 ms-5">
                        <add-vehicle></add-vehicle>
                     </div>


                     <product-search class="mx-5"></product-search>

                     <div class="menu-i menu-i  w-25 me-5">
                        <a href="" role="button" class="w-100 mb-0 border-0">
                           <div class="d-flex add-a-vehicle justify-content-evenly align-content-center">
                              <span class="material-symbols-outlined">
                                 local_library
                              </span>
                              <div class="align-self-center fw-bold  fs-6">How To</div>
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
         <div class="container-fluid  d-block d-sm-none">
            <product-search></product-search>
         </div>





         <div class="container-fluid  d-block d-sm-none">

            <div class="d-flex w-100">
               <div class="menu-i w-50 me-1">

                  <button class="nav-btn  w-100 mb-0 py-4 bg-transparent  border">
                     <add-vehicle></add-vehicle>

                  </button>
               </div>


               <div class="menu-i w-50 py-4 border">
                  <a href="" role="button" class="w-100 mb-0 border-0">
                     <div class="d-flex add-a-vehicle justify-content-evenly align-content-center">
                        <span class="material-symbols-outlined">
                           local_library
                        </span>
                        <div class="align-self-center fw-bold  fs-6">How To</div>
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
         @yield('content')
         <modal-search></modal-search>
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


               </div>

               <div class="d-none d-lg-block d-md-block d-xl-block">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap  ">
                     <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                     @if ( auth()->check() && auth()->user()->isAdmin() )
                     <p class="footer-copyright mx-3 text-white"><a target="_blank" href="/admin">Go to Admin</a></p>
                     @endif
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
               @auth
               <a href="/account" class="header-icon  d-flex" title="account">
                  <img src="/images/utils/signin.svg" alt="">
                  <span class="text-sm ml-2">Account</span>
               </a>
               @endauth
               @guest

               <a href="/account" class="header-icon  d-flex" title="account">
                  <img src="/images/utils/signin.svg" alt="">
                  <span class="text-sm">Signin</span>
               </a>
               @endguest
               <div class="menu">Wallet</div>
            </div>

            <ul class="mobile-menu mt-3">
               @foreach( $global_categories as $category)
               <li>
                  <a class="py-4" href="{{  $category->link ? $category->link : '/products/'.$category->slug }}">{{ $category->name }}</a>
                  @if ($category->isCategoryHaveMultipleChildren())
                  <ul>
                     @foreach ( $category->children as $children)

                     <li>
                        <a href="/products/{{ $children->slug }}" class="category-heading">{{ $children->name }} </a>
                        @if ($children->children->count())
                        <ul>
                           @foreach ( $children->children as $children)
                           <li><a href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                           @endforeach
                        </ul>
                        @endif
                     </li>
                     @endforeach
                  </ul>
                  @elseif ( !$category->isCategoryHaveMultipleChildren() && $category->children->count() )
                  <ul>
                     @foreach ( $category->children as $children)
                     <li><a class="category-heading" href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                     @endforeach
                  </ul>
                  @endif
               </li>

               @endforeach
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

   <div class="watsapp ">
      <a class="chat-on-watsapp d-flex justify-content-between align-items-center" target="_blank" href="https://wa.me/+2">
         <span class="d-flex flex-column me-4">
            <span>Need help?</span>
            <span>
               Chat with us
            </span>
         </span>
         <i class="fab fa-whatsapp fa-2x  mr-2 text-success"></i>
      </a>
   </div>

   <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

   <!-- Plugins JS File -->
   <script src="/js/jquery.min.js"></script>
   <script src="/js/app.js"></script>


   @yield('page-scripts')
   <script type="text/javascript">
      @yield('inline-scripts')

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

</html>