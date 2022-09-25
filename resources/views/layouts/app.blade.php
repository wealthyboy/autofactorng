<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Autofactor') }}</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Include Choices CSS -->
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container-fluid d-block d-sm-none">
            <div class=" g-0 d-flex  justify-content-between align-items-center">
                <div class="col-">
                    <div class="menu">
                        <button   data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="nav-btn menu-nav-btn mb-0 pb-0 p-0" role="button" >
                            <span class="menu-open">
                                <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/hamburger.svg" alt="" srcset="">
                                <span class="text-xs">Menu</span>
                            </span>

                            <span class="menu-close d-none">
                                <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" alt="" srcset="">
                                <span class="text-xs">Close</span>
                            </span>
                                
                        </button>
                    </div>
                </div>
                <div class="col-m">
                    <div class="logo">
                        <a class="d-block" href="/">
                            <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
                        </a>
                    </div>
                </div>
                
                <div class="col-">
                    <div class="header-icons d-flex justify-content-evenly">
                        <div class="dropdown">
                            <button class="  mr-5 nav-btn mb-0 pb-0" type="button" >
                                <span class="">
                                   
                                <img   src="/images/utils/signin.svg" alt="" srcset="">
                                   
                                    <div  class="text-xs">Sign in</div>
                                </span>
                            </button>
                            
                         </div>
                        <a href="#">
                             <span class="cart-count badge-circle">3</span>
                            <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/az-cart-nav.svg" alt="" srcset="">
                            <div  class="text-xs">Cart</div>
                        </a>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12">
                <div class="input-group border">
                    <button class="btn bg-white mb-0" type="button" id="button-addon1">
                        <i class="bi bi-search"></i>
                    </button>
                    <input type="text" class="form-control search-input bg-white" placeholder="Find parts and products" aria-label="Example text with button addon" aria-describedby="button-addon1">
                </div>
            </div>
        </div>
        <div class="container-fluid d-none d-lg-block d-md-block d-xl-block">
            <div class="row g-0 d-flex py-4 justify-content-center align-items-center">
                <div class="col-md-4">
                    <div class="logo d-flex">
                        <a class="d-block" href="/">
                            <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 text-left">
                   
                </div>
                <div class="col-md-2">
                    <div class="header-icons d-flex justify-content-between">
                       <div class="dropdown  ms-7">
                            <button class="mr-5 nav-btn mb-0 pb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="">
                                    <img   src="/images/utils/signin.svg" alt="" srcset="">
                                    <span class="ml-3">
                                        <img  src="/images/utils/down-arrow.svg" alt="" srcset="">
                                    </span>
                                    <div class="text-xs me-3">Sign in</div>
                                </span>
                            </button>
                            
                        </div>
                        <div class="me-3">
                            <a class="my-3 position-relative" href="/cart">
                                <span class="position-absolute top-2 start-100 translate-middle badge rounded-circle bg-danger border border-white small  px-2">
                                    99
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/az-cart-nav.svg" alt="" srcset="">
                                <div class="text-xs">Cart</div>
                                
                            </a>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="nav d-none d-lg-block d-md-block d-xl-block">
            <div class="container-fluid">
                <div class="row nav-container  d-flex justify-content-center align-items-center pb-1">
                    <div class="col-md-1">
                        <div class="menu">
                            <button   data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="nav-btn menu-nav-btn mb-0 pb-0" role="button" >
                                <span class="menu-open">
                                    <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/hamburger.svg" alt="" srcset="">
                                    <div class="text-xs">Menu</div>
                                </span>

                                <span class="menu-close d-none">
                                    <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" alt="" srcset="">
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
                        <div class="input-group">
                            <button class="btn bg-white mb-0" type="button" id="button-addon1">
                                <i class="bi bi-search"></i>
                            </button>
                            <input type="text" class="form-control search-input bg-white" placeholder="Find parts and products" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="text">
                            <a href="#" class="nav-btn  w-100 mb-0">
                                <div class="d-flex add-a-vehicle justify-content-evenly">
                                    <div class="ml-3">
                                      <i class="bi bi-camera-reels-fill"></i>                                    </div>
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

        <div data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="overlay d-none">
            <div  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" ></div>
        </div>
        
       
        <main class="py-3">
            @yield('content')
        </main>
        
        <div class="py-3 subscribe  text-white">
            <div class="container">
                <div class="row">
                <div class="col-lg-6 text-start">
                    <h4 class="text-white">Get tips & tricks</h4>
                    <span class="mb-0">Subscribe to get the latest deals, promotions, and offerings.</span>
                </div>
                <div class="col-lg-5 ms-auto text-end my-auto">
                    <div class="row g-0">
                        <div class="col-lg-8 col-10 ">
                            <div class="input-group input-group-outline">
                            <label class="form-label">Your Email</label>
                            <input class="form-control rounded-0 bg-white" placeholder="Enter your email" type="email" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-2 text-start ps-0">
                            <button type="button" class="btn  bg-white rounded-0 bg-gradient-dark mb-0"><i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <footer class="footer py-5 text-white font2">
            <!-- -------   START PRE-FOOTER 4 - title & description and input    -------- -->
            
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
                        <div class="social-icons py-3">
                            <a href="#" class="bi bi-facebook text-white  me-4 fa-2x" target="_blank" title="Facebook"></a>
                            <a href="#" class="bi bi-twitter  text-white me-4 fa-2x" target="_blank" title="Twitter"></a>
                            <a href="#" class="bi bi-instagram  text-white me-4 fa-2x" target="_blank" title="Linkedin"></a>
                        </div><!-- End .social-icons -->
                    </div><!-- End .footer-bottom -->
                </div>
                
            </div><!-- End .container -->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>



      @yield('page-scripts')    
      <script type="text/javascript">
        @yield('inline-scripts')


      </script>
</body>
</html>
