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

   <!-- Google Tag Manager -->
   <script>
      (function(w, d, s, l, i) {
         w[l] = w[l] || [];
         w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
         });
         var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
         j.async = true;
         j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
         f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-PJJKCVSR');
   </script>
   <!-- End Google Tag Manager -->


   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-BZEG8EJ1VC"></script>
   <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
         dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'G-BZEG8EJ1VC');
   </script>


</head>


<body>
   <!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJJKCVSR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->
   <div id="app" class="page-wrapper">


      <header class="header ">
         <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
            <div class=" d-none d-lg-block d-xl-block w-100">

               <div class="container-fluid justify-content-end ">
                  <div class="header-left col-lg-2 w-auto pl-0">
                     <button class="mobile-menu-toggler  no-hover mr-2" type="button">
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
                        <a href="/account" class="d-flex flex-column align-items-center no-hover text-black" title="account">
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
                        <a href="/login" class="d-flex flex-column align-items-center no-hover text-black" title="account">
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
            </div>
            <div class="container-fluid w-100  d-md-block d-lg-none d-sm-block">


               <div class="header-lefts   d-flex justify-content-between align-items-center w-100">
                  <button class="mobile-menu-toggler  no-hover mr-2 d-flex flex-column align-items-center display-3" type="button">
                     <i class="fas fa-bars"></i>
                     <span class=" fs-5">Menu</span>
                  </button>
                  <a href="/" class="logo ms-4">
                     <img src="https://autofactor.ng/images/logo/autofactor_logo.png" alt="Autofactor  Logo">
                  </a>

                  <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0"></div>
                  <!-- End .header-search -->

                  <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                     <img alt="phone" src="/assets/images/phone.png" width="30" height="30" class="pb-1">
                     <h6><span>Call to order</span><a href="tel:#" class="text-dark font1">{{optional($system_settings)->store_phone }}</a></h6>
                  </div>
                  @auth
                  <div class="position-relative  me-s">
                     <a href="tel:{{optional($system_settings)->store_phone }}" class="d-flex flex-column align-items-center no-hover text-black" title="account">
                        <span class="material-symbols-outlined display-3">
                           phone
                        </span>
                        <span class="header-right-icons  cart-text fs-5">
                           Call
                        </span>
                     </a>
                  </div>
                  <div class="position-relative  me-s">
                     <a href="/account" class="d-flex flex-column align-items-center" title="account">
                        <span class="material-symbols-outlined display-2">
                           person
                        </span>
                        <span class="header-right-icons  fs-5">
                           Account
                        </span>
                     </a>
                  </div>

                  @endauth

                  @guest
                  <div class="position-relative  me-s">
                     <a href="tel:{{optional($system_settings)->store_phone }}" class="d-flex flex-column align-items-center no-hover text-black" title="account">
                        <span class="material-symbols-outlined display-3">
                           phone
                        </span>
                        <span class="header-right-icons  cart-text fs-5">
                           Call
                        </span>
                     </a>
                  </div>
                  <div class="position-relative ">

                     <a href="/login" class="d-flex flex-column align-items-center" title="account">
                        <span class="material-symbols-outlined display-3">
                           person
                        </span>
                        <span class="header-right-icons   fs-5">
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
               <!-- End .header-left -->


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
                        <add-vehicle :years="{{ $yrs }}"></add-vehicle>
                     </div>


                     <product-search class="mx-5"></product-search>

                     <div class="menu-i menu-i  w-25 me-5">
                        <a href="/video-tips" role="button" class="w-100 mb-0 border-0">
                           <div class="d-flex add-a-vehicle justify-content-evenly align-content-center">
                              <span class="material-symbols-outlined">
                                 <i class="bi bi-camera-video fs-1"></i>
                              </span>
                              <div class="align-self-center fw-bold  fs-5">Video Tips</div>
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
         <div class="container-fluid   d-md-block d-lg-none d-sm-block">
            <product-search></product-search>
         </div>



         <div class="container-fluid   d-md-block d-lg-none d-sm-block">

            <div class="d-flex w-100">
               <div class="menu-i w-50 me-1">

                  <button class="nav-btn  w-100 mb-0 py-4 bg-transparent  border">
                     <add-vehicle></add-vehicle>
                  </button>
               </div>


               <div class="menu-i w-50  d-flex add-a-vehicle justify-content-evenly align-items-center border">
                  <a href="/video-tips" role="button" class="w-100  ">
                     <div class="d-flex add-a-vehicle justify-content-evenly align-items-center">

                        <span class="">
                           <i class="bi bi-camera-video fs-1"></i></span>
                        <div class="align-self-center fw-bold ">Video Tips</div>

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

      <div class="footer bg-dark site-footer">
         <div class="py-2 subscribe  border-bottom  ">
            <div class="container-fluid bg-dark">
               <div class="row justify-content-center align-items-center no-gutters py-4">
                  <div class="col-12 col-lg-6">
                     <div class="mc-mb-6 mc-mb-md-9 mc-mb-lg-0">
                        <div class="mb-sm-2">
                           <h1 class="text-white  fs-3 mb-sm-3">Sign up to our newsletter for updates and deals</h1>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-5 offset-lg-1">
                     <h1 id="s-messge" class="text-white  fs-3 mb-sm-3"></h1>
                     <form method="POST" id="n-letter" class="mb-0 ">
                        <div class="row g-0">
                           <div class="row g-0">
                              <div class="col-8"><input id="email" type="text" class="form-control b rounded-0 email coupon-i" placeholder="Enter  your email" required=""></div>
                              <div class="col-4 coupon-i">
                                 <button class="btn btn-sm w-100 rounded-0  bg-main bold fs-3 text-white" type="submit"><!--v-if-->
                                    <span class="spinner-border spinner-border-sm n-spinner d-none" role="status" aria-hidden="true"></span>

                                    Submit </button>
                              </div>
                           </div>

                        </div>
                     </form>

                     <div class="text-white sub-message"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-middle">
            <!-- -------   END PRE-FOOTER 4 - title & description and input    -------- -->
            <div class="container-fluid bg-dark">
               <div class="footer-middle mt-5">
                  <div class="">
                     @include('layouts.footer.desktop_footer')
                  </div>
               </div><!-- End .footer-middle -->

               <div class="mobile-footer text-center  d-block d-sm-none">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap">
                     <a href="https://www.facebook.com/autofactorng/" class="bi bi-facebook text-white  me-5 fa-2x" target="_blank" title="Facebook"></a>
                     <a href="https://twitter.com/autofactorng/" class="bi bi-twitter  text-white me-5 fa-2x" target="_blank" title="Twitter"></a>
                     <a href="http://instagram.com/autofactorng/" class="bi bi-instagram  text-white  fa-2x" target="_blank" title="Linkedin"></a>
                  </div><!-- End .footer-bottom -->
                  <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                  @if ( auth()->check() && auth()->user()->isAdmin() )
                  <p class="footer-copyright mx-3 text-white"><a target="_blank" class="text-white" href="/admin">Go to Admin</a></p>
                  @endif


               </div>

               <div class="d-none d-lg-block d-md-block d-xl-block">
                  <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap  ">
                     <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                     @if ( auth()->check() && auth()->user()->isAdmin() )
                     <p class="footer-copyright mx-3 text-white"><a target="_blank" class="text-white" href="/admin">Go to Admin</a></p>
                     @endif
                     <div class="social-icons py-3">
                        <a href="https://www.facebook.com/autofactorng/" class="bi bi-facebook text-white  me-5 fa-2x" target="_blank" title="Facebook"></a>
                        <a href="https://twitter.com/autofactorng/" class="bi bi-twitter  text-white me-5 fa-2x" target="_blank" title="Twitter"></a>
                        <a href="http://instagram.com/autofactorng/" class="bi bi-instagram  text-white  fa-2x" target="_blank" title="Linkedin"></a>
                     </div><!-- End .social-icons -->
                  </div><!-- End .footer-bottom -->
               </div>

            </div><!-- End .container -->
         </div>
         <!-- End .footer-middle -->

         <div class="container">

         </div>
         <!-- End .container -->
      </div>
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
            <div class="d-flex  border-bottom px-4  justify-content-between"></div>

            <div class="accordion accordion-flush" id="accordionNav">
               @foreach( $global_categories as $category)

               <div class="accordion-item">
                  <h2 class="accordion-header mb-0 py-3" id="flush-heading{{$category->id}}">
                     <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $category->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $category->id }}">
                        {{ $category->name }}
                     </button>
                  </h2>
                  <div id="flush-collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $category->id}}" data-bs-parent="#accordionNav">
                     <div class="accordion-body">

                        @if ($category->children->count())
                        <ul>
                           @foreach( $category->children as $category)
                           <li class="py-2">
                              <a href="{{  $category->link ? $category->link : '/products/'.$category->slug }}?t={{time()}}">

                                 {{ $category->name }}
                              </a>

                           </li>
                           @endforeach
                        </ul>
                        @else
                        <ul>
                           <li class="py-3">
                              <a href="{{ $category->children->count() ? '#' : '/products/'.$category->slug }}?t={{time()}}">
                                 All {{ $category->name }}
                              </a>

                           </li>
                        </ul>
                        @endif

                     </div>
                  </div>
               </div>
               @endforeach



            </div>

         </nav>
         <!-- End .mobile-nav -->

      </div>
      <!-- End .mobile-menu-wrapper -->
   </div>
   <!-- End .mobile-menu-container -->





   <div class="watsapp me-3">
      <a class="chat-on-watsapp d-flex justify-content-between align-items-center" target="_blank" href="https://wa.me/+23409081155505">
         <span class="d-flex flex-column me-2">
            <span class="fs-6">Need Help?</span>
            <span class="fs-5">Chat with us</span>
         </span>
         <span class="me-1">
            <img src="/images/utils/afng-whatsapp.png" alt="" width="35" srcset="">
         </span>
      </a>
   </div>

   <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

   <!-- Plugins JS File -->
   <script src="/js/jquery.min.js"></script>
   <script src="/js/app.js"></script>


   @yield('page-scripts')
   <script type="text/javascript">
      @yield('inline-scripts')

      $('#n-letter').on('submit', function(e) {
         e.preventDefault()

         let email = $(this).serialize()
         let spinner = $(".n-spinner")
         spinner.removeClass('d-none')
         let form = $(this)


         axios
            .post("/api/newsletter/signup", {
               email: $('.email').val()
            })
            .then((response) => {
               $('.email').val('')
               form.addClass('d-none')
               $('#s-messge').removeClass('d-none').html("Thanks for subscribing")
               setInterval(() => {
                  form.removeClass('d-none')
                  $('#s-messge').addClass('d-none').html()
               }, 3000)
               spinner.addClass('d-none')
            })
            .catch((error) => {
               $(this).removeClass('d-none')
               spinner.addClass('d-none')
            });



      })

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