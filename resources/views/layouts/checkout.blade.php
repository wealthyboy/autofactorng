<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ isset($page_title) ? $page_title .' |  '.config('app.name') :  $system_settings->meta_title  }}</title>

    <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="keywords" content="{{ isset($meta_tag_keywords) ? $meta_tag_keywords : $system_settings->meta_tag_keywords }}" />
    <link rel="canonical" href="{{ Config('app.url') }}">
    <meta name="author" content="AuofactorNG">

    <link rel="stylesheet" preload href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/favicon_io/favicon-32x32.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon_io/favicon.ico">
    <link rel="icon" href="/images/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/images/favicon_io/favicon-96x96.png">
    <!-- Main CSS File -->

    <link rel="stylesheet" href="/css/app.css?id={{ rand(1,2000)}}">



    <meta property="og:site_name" content="Autofactorng Co">
    <meta property="og:url" content="https://autofactorng.com/">
    <meta property="og:title" content=" autofactorng">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta property="og:image:alt" content="">
    <meta name="twitter:site" content="@autofactorng">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="twitter:description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">

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

                        <a href="/" class="logo">
                            <img src="https://autofactorng.com/images/logo/autofactor_logo.png" alt="Autofactor  Logo">
                        </a>
                    </div>

                    <div class="header-right w-lg-max">

                        <div class="dropdown cart-dropdown">
                        </div>
                        <!-- End .dropdown -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-middle -->


            <!-- End .header-bottom -->
        </header>
        <!-- End .header -->

        <main class="main  bg-light">
            @yield('content')
        </main>

        <!-- End .main -->

        <footer class="footer bg-dark">
            <div class="footer-middle">
                <!-- -------   END PRE-FOOTER 4 - title & description and input    -------- -->
                <div class="container">


                    <div class="mobile-footer text-center  d-block d-sm-none">
                        <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap">
                            <a href="https://www.facebook.com/autofactorng/" class="bi bi-facebook text-white  me-5 fa-2x" target="_blank" title="Facebook"></a>
                            <a href="https://twitter.com/autofactorng/" class="bi bi-twitter  text-white me-5 fa-2x" target="_blank" title="Twitter"></a>
                            <a href="http://instagram.com/autofactorng/" class="bi bi-instagram  text-white  fa-2x" target="_blank" title="Linkedin"></a>
                        </div><!-- End .footer-bottom -->
                        <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
                    </div>

                    <div class="d-none d-lg-block d-md-block d-xl-block">
                        <div class="footer-bottom text-white d-flex  justify-content-between align-items-center flex-wrap  ">
                            <p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. {{ date('Y') }}. All Rights Reserved</p>
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
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>


    <!-- Plugins JS File -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/app.js"></script>

</body>

</html>