<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ isset($page_title) ? $page_title .'   '.config('app.name') :  $system_settings->meta_title  }}</title>
    <meta property="og:title" content="{{ isset($seo['page_title']) ? $seo['page_title'] : optional($system_settings)->meta_title }}">
    <meta name="description" content="{{ isset($seo['page_meta_description'])  ? $seo['page_meta_description'] : optional($system_settings)->meta_description }}">
    <meta name="keywords" content="" />
    <link rel="canonical" href="{{ Config('app.url') }}">
    <meta name="author" content="Autofactorng">

    <link rel="icon" type="image/x-icon" href="/images/favicon_io/favicon-32x32.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon_io/favicon.ico">
    <link rel="icon" href="/images/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/images/favicon_io/favicon-96x96.png">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="{{ isset($seo['type']) ? $seo['type'] : 'website' }}">
    <meta property="og:site_name" content="Autofactorng">
    <meta property="og:url" content="{{ isset($seo['url']) ? $seo['url'] : 'https://autofactorng.com' }}">
    <meta property="og:description" content="{{ isset($seo['page_meta_description']) ? $seo['page_meta_description'] : optional($system_settings)->meta_description }}">
    <meta property="og:image:width" content="720" />
    <meta property="og:image:height" content="700" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image" content="{{ isset($seo['image']) ? $seo['image'] : 'https://autofactorng.com/images/logo/autofactor_logo.png' }}" />
    <meta name="twitter:site" content="@autofactorng">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ isset($seo['title']) ? $seo['title'] : $system_settings->meta_title }}">
    <meta name="twitter:description" content="{{ isset($seo['page_meta_description']) ? $seo['page_meta_description'] : $system_settings->meta_description }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">


    <style>
        .hero {
            background-color: #fff;
            padding: 3rem 1rem;
            text-align: center;
            position: relative;
        }

        .hero img.cars {
            width: 100%;
            max-width: 1100px;
            margin: 2rem auto 0;
        }

        .hero img.logo-badge {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            max-width: 180px;
            top: 55%;
        }

        @media (max-width: 768px) {
            .hero img.logo-badge {
                position: static;
                transform: none;
                margin: 2rem auto;
            }
        }

        .forum-hero {
            background-image: url('/images/utils/worker.jpg');
            /* Replace with your image */
            background-size: cover;
            background-position: center;
            height: 500px;
            position: relative;
            color: white;
        }

        .forum-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .forum-hero .container {
            position: relative;
            z-index: 2;
        }

        .pm-color {
            background-color: #f26100 !important;
        }

        .text-pm-color {
            color: #f26100 !important;
        }

        .thread-row {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .thread-title {
            font-weight: 500;
        }

        .thread-title.pinned::before {
            content: '';
            display: inline-block;
            margin-right: 6px;
        }

        .thread-meta {
            color: #777;
            font-size: 0.875rem;
        }

        .meta-cell {
            flex: 0 0 80px;
            text-align: center;
        }

        .topic-cell {
            flex: 1;
        }

        .ck-editor__editable_inline {
            min-height: 20 0px !important;
            height: auto;
            overflow-y: auto;
        }


        .ck-editor__editable_inline {
            min-height: 200px !important;
            height: auto;
            overflow-y: auto;
        }

        .c-button,
        .c-btn {
            background-color: #f26100 !important;
            border-color: #f26100 !important;
            color: white !important;
        }

        .c-button:hover,
        .c-btn:hover {
            background-color: #d25500 !important;
            /* slightly darker for hover */
            border-color: #d25500 !important;
        }

        #replyFormContainer {
            opacity: 0;
            pointer-events: none;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1050;
        }

        #replyFormContainer.active {
            opacity: 1;
            pointer-events: auto;
            visibility: visible;
        }

        .skeleton-avatar {
            width: 40px;
            height: 40px;
            background-color: #dee2e6;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        .skeleton-line {
            height: 12px;
            background-color: #dee2e6;
            border-radius: 4px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1
            }

            50% {
                opacity: 0.5
            }

            100% {
                opacity: 1
            }
        }

        #skeleton-wrapper {
            transition: opacity 0.3s ease;
        }

        #skeleton-wrapper.d-none {
            opacity: 0;
            pointer-events: none;
        }

        input:focus,
        textarea:focus,
        select:focus,
        button:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body class="h-full flex flex-col">
    <div id="app" class="page-wrapper">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
            <div class="container">
                <a href="/forum" class="logo"><img src="https://autofactorng.com/images/logo/autofactor_logo.png" alt="Autofactor  Logo"></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/forum">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" href="/car-reviews">Car Reviews</a></li>
                        <li class="nav-item"><a class="nav-link" href="/video-tips">Video Tips & Tutorials</a></li>
                    </ul>

                    <div class="d-flex gap-2">
                        @auth
                        <a href="/topic/create" class="btn pm-color text-white">New Topic</a>
                        @else
                        <a href="/login?forum={{ csrf_token() }}" class="btn pm-color text-white">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>


        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Hero Section -->

        <div class="bg-light" style="height: 8rem;">

        </div>

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

    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="/js/forum.js?id={{ rand(1,2000)}}"></script>


    @stack('scripts')
</body>

</html>