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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container-fluid d-block d-sm-none">
            <div class=" g-0 d-flex  justify-content-center align-items-center">
                <div class="col-">
                    <div class="menu">
                        <button   data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="nav-btn menu-nav-btn mb-0 pb-0" role="button" >
                            <span class="menu-open">
                                <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/hamburger.svg" alt="" srcset="">
                                <div>Menu</div>
                            </span>

                            <span class="menu-close d-none">
                                <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" alt="" srcset="">
                                <div>Close</div>
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
                        <button class="mr-5 nav-btn mb-0 pb-0">
                            <span class="">
                                <img   src="/images/utils/signin.svg" alt="" srcset="">
                                <span class="ml-1">
                                    <img  src="/images/utils/down-arrow.svg" alt="" srcset="">
                                </span>
                                <div>Sign in</div>
                             </span>
                        </button>
                        <a href="#">
                            <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/az-cart-nav.svg" alt="" srcset="">
                            <div>Cart</div>

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
        <div class="container-fluid 	d-none d-lg-block d-md-block d-xl-block">
            <div class="row g-0 d-flex py-4 justify-content-center align-items-center">
                <div class="col-md-4">
                    <div class="logo d-flex">
                        <a class="d-block" href="/">
                            <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="nav-link-text">
                        <a href="/lp/autozone-savings" target="">
                            <div class="fs-6">
                                <p>Autocovery**  We ship to anywhere in nigeria</p> 
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="header-icons d-flex justify-content-evenly">
                        <button class="mr-5 nav-btn mb-0 pb-0">
                            <span class="">
                                <img   src="/images/utils/signin.svg" alt="" srcset="">
                                <span class="ml-1">
                                    <img  src="/images/utils/down-arrow.svg" alt="" srcset="">
                                </span>
                                <div>Sign in</div>
                             </span>
                        </button>
                        
                        <a href="#">
                            <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/az-cart-nav.svg" alt="" srcset="">
                            <div>Cart</div>
                        </a>
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
                                    <div>Menu</div>
                                </span>

                                <span class="menu-close d-none">
                                    <img  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" src="/images/utils/close-dark.svg" alt="" srcset="">
                                    <div>Close</div>
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
                                    <div>
                                      <i class="bi bi-camera-reels-fill"></i>                                    </div>
                                    <div>How to</div>
                                    <div> 
                                        <img src="/images/utils/header-arrow.svg" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offcanvas offcanvas-start w-30" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
                <div class="offcanvas-header">
                    <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Most Popular</h6>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ">
                    <ul class="list-unstyled pl-3">
                        <li>
                            <a href="/batteries-starting-and-charging/battery " target="" data-testid="at_popular_part_list_item_0" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Batteries</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/motor-oil-and-transmission-fluid/engine-oil" target="" data-testid="at_popular_part_list_item_1" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Engine Oil</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/brakes-and-traction-control/brake-pads" target="" data-testid="at_popular_part_list_item_2" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Brake Pads</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/brakes-and-traction-control/brake-rotor" target="" data-testid="at_popular_part_list_item_3" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Brake Rotors</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/filters-and-pcv/oil-filter" target="" data-testid="at_popular_part_list_item_4" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Oil Filter</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/filters-and-pcv/air-filter" target="" data-testid="at_popular_part_list_item_5" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Air Filter</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/external-engine/spark-plug" target="" data-testid="at_popular_part_list_item_6" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Spark Plug</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/ignition-tune-up-and-routine-maintenance/wiper-blade-windshield" target="" data-testid="at_popular_part_list_item_7" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Wiper Blades</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/collision-body-parts-and-hardware/headlight" target="" data-testid="at_popular_part_list_item_8" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Headlight Bulb</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/fluids-and-chemicals/car-wash-and-detailing" target="" data-testid="at_popular_part_list_item_9" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Car Wash and Detailing</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/batteries-starting-and-charging/alternator" target="" data-testid="at_popular_part_list_item_10" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Alternators</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/cooling-heating-and-climate-control/radiator" target="" data-testid="at_popular_part_list_item_11" tabindex="0">
                                <div class="az_ylb">
                                    <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                                    <div class="az_-i">Radiators</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="offcanvas-header">
                    <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Most Popular</h6>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
               
                </div>
               
            </div>
            
        </div>

        <div data-bs-toggle="offcanvas" data-bs-target="#offcanvas" class="overlay d-none">
            <div  data-bs-toggle="offcanvas" data-bs-target="#offcanvas" ></div>
        </div>
        
       
        <main class="py-4">
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


      @yield('page-scripts')    
      <script type="text/javascript">
        @yield('inline-scripts')

        
      </script>
</body>
</html>
