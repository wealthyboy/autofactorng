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
        <header class="header py-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo d-flex">
                            <a class="d-block" href="/">
                                <img src="/images/logo/autofactor_logo.png" alt="" srcset="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="nav-back">
            <div class="container-fluid">
                <div class="row">
                    <div class="mt-3">
                        <a href="http://"> BACK TO CART</a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="mt-3">
                                <img src="/images/utils/icon-lock.svg" alt="" class="az_pe" data-testid="checkout-title-img">
                            </div>
                            <h2 class="">
                                <div data-testid="hidden-root" class="az_rO">SECURE </div>
                            </h2>
                            <div class="ml-3">
                                <h2 class="">
                                    CHECKOUT
                                </h2>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-3 bg-light">
            @yield('content')
        </main>

        <footer class="footer font2">           
            <!-- -------   END PRE-FOOTER 4 - title & description and input    -------- -->
            <div class="container">
                <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
                    <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                    <div class="social-icons py-3">
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                        <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                    </div><!-- End .social-icons -->
                </div><!-- End .footer-bottom -->
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
