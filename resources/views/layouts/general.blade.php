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
        
       
       
        <main class="py-4 ">
            @yield('content')
        </main>

        <footer class="footer font2">            
            <div class="footer-bottom text-white d-flex border-top justify-content-between align-items-center flex-wrap">
                <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>

                <div class="social-icons py-3">
                    <a href="#" class="bi bi-facebook text-white mr-2" target="_blank" title="Facebook"></a>
                    <a href="#" class="bi bi-twitter  text-white" target="_blank" title="Twitter"></a>
                    <a href="#" class="bi bi-instagram  text-white" target="_blank" title="Linkedin"></a>
                </div><!-- End .social-icons -->
            </div><!-- End .footer-bottom -->
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('page-scripts')    
      <script type="text/javascript">
        @yield('inline-scripts')
      </script>
</body>
</html>
