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
            '<?php echo $user; ?>'
        },
        settings: {
            '<?php echo $system_settings; ?>'
        },
        token: '<?php echo csrf_token(); ?>'
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

        <main class="main">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- End .main -->

        <footer class="footer bg-dark">
            <div class="footer-middle">
                <!-- -------   END PRE-FOOTER 4 - title & description and input    -------- -->
                <div class="container">


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

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/app.js"></script>

</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/layouts/checkout.blade.php ENDPATH**/ ?>