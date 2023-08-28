<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>{{ Config('app.name') }}  Coming soon</title>
        <meta name="author" content="AchuWorld">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : '' }}">
        <meta name="keywords" content="{{ isset($settings->meta_tag_keywords) ? $settings->meta_tag_keywords : '' }}" />
        <meta name="generator" content="Social Likes: http://social-likes.js.org/">

  

  <!-- Favicon -->
  <link rel="icon" href="favicon.png" type="image/png">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/maintainance/css/plugins/bootstrap.min.css">

  <!-- Font Icons -->
  <link rel="stylesheet"
        href="/maintainance/css/icons/font-awesome.css">
  <link rel="stylesheet"
        href="/maintainance/css/icons/linea.css">

  <!-- Google Fonts -->
  <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="/maintainance/css/plugins/loaders.min.css">
  <link rel="stylesheet" href="/maintainance/css/plugins/photoswipe.css">
  <link rel="stylesheet" href="/maintainance/css/icons/photoswipe/icons.css">


  <!-- Custom CSS -->
  <link rel="stylesheet" href="/maintainance/css/style.css">

  <!-- Responsive CSS -->
  <link href="/maintainance/css/responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body data-spy="scroll" data-target=".scrollspy" class="bg-dark show-content full-info">

<!-- Preloader  -->
<div class="loader bg-dark">
  <div class="loader-inner ball-scale-ripple-multiple ball-scale-ripple-multiple-color">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- /End Preloader  -->



<div id="page">

  <!-- ============================
       BG & Overlays
  ================================= -->

  <!-- Image BG -->
  <div class="section-overlay media page-image-bw reveal scale-in"></div>
  <!-- /End Image BG -->

  <!-- Overlay BG -->
  <div class="section-overlay bg-black overlay-opacity-3"></div>
  <!-- /End Overlay BG -->

  <!-- Modal -->
  <div id="modal-notify" class="modal fade modal-scale" tabindex="-1" role="dialog"
       aria-labelledby="meinModalLabel">

    <!-- .modal-dialog -->
    <div class="modal-dialog" role="document">
      <div>

        <!-- .modal-content -->
        <div class="modal-content text-center bg-dark text-light">
          <button class="button-close" data-dismiss="modal" aria-label="Close"><i
              class="icon icon-lg icon-arrows-remove"></i></button>


          <!-- Headline -->
          <div class="wrap-line border-dark">
            <h3><span class="font-weight-200">Stay</span> Tuned</h3>
          </div>
          <!-- /End Headline -->

          <!-- Description -->
          <div class="p-t-b-15">
            <p>AvenueMontaigne is comming soon.<br>

             </p>
          </div>
          <!-- /End Description -->

          <div class="p-t-b-30">

            <!-- Newsletter Form:
             alternative newsletter form via email;
             write your email in newsletter-process.php and use:
             <form action="php/newsletter-process.php" id="newsletter-form" method="post"> insted of
             <form id="mc-form"> -->
            <form id="mc-form">

              <!-- Input Group -->
              <div class="input-group">
                <input type="email" id="email" class="form-control form-control-light"
                       name="email"
                       placeholder="Enter your Email here...">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-white"><i
                        class="icon icon-sm icon-arrows-slim-right-dashed"></i>
                    </button>
                  </span>
              </div>
              <!-- /End Input Group -->

              <!-- Message Alert -->
              <div id="message-newsletter" class="message-wrapper text-white message">

                <span><i class="icon icon-sm icon-arrows-slim-right-dashed"></i><label
                    class="message-text" for="email"></label></span>
              </div>
              <!-- /End Message Alert -->

            </form>
            <!-- /End Newsletter Form -->

          </div>
        </div>

      </div>
      <!-- /End .modal-content -->
    </div>
    <!-- /End .modal-dialog -->
  </div>
  <!-- /End Modal -->

  <!-- ============================
       Header Navigation
  ================================= -->

  <header>
    <nav class="navbar navbar-fixed-top">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-white col-transform">
            <div class="navbar-wrapper">

              <!-- Navbar Button -->
              <!-- <button class="navbar-button show-info" data-href="#content">
                <span></span>
                <span></span>
                <span></span>
              </button> -->
              <!-- /End Navbar Button -->

              <!-- Navbar Links -->
              <!-- <div class="navbar-links scrollspy">
                <ul class="nav">
                  <li><a class="smooth-scroll link-white" href="#about">About</a></li>
                  <li><a class="smooth-scroll link-white" href="#contact">Contact</a></li>
                </ul>
              </div> -->
              <!-- /End Navbar Links -->

            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="container-fluid">
    <div class="row">


      <!-- ============================
           Info
      ================================= -->

      <div id="info" class="col-md-12 text-white text-center page-info col-transform">
        <div class="vert-middle">
          <div class="reveal scale-out">

            <!-- Logo -->
            <!-- <div class="p-t-b-15">
              <img src="images/logo-lg.png" height="86" width="70" alt="">
            </div> -->
            <!-- /End Logo -->

            <div class="p-t-b-15">
              <!-- Headline & Description -->
              <h2><span class="font-weight-200">AvenueMontaigne</span><br>is coming soon</h2>

              
              <!-- /End Headline & Description -->
            </div>
            <!-- Arrow -->
            <div class="p-t-b-20">
              <i class="icon icon-sm icon-arrows-slim-down-dashed"></i>
            </div>
            <!-- /End Arrow -->

           


          </div>
        </div>
      </div>


    </div>
  </div>

</div>
<!-- /#page -->
<div id="photoswipe"></div>

<!-- Scripts -->
<script src="/maintainance/js/plugins/jquery1.11.2.min.js"></script>
<script src="/maintainance/js/plugins/bootstrap.min.js"></script>
<script src="/maintainance/js/plugins/scrollreveal.min.js"></script>
<script src="/maintainance/js/plugins/contact-form.js"></script>
<script src="/maintainance/js/plugins/newsletter-form.js"></script>
<script src="/maintainance/js/plugins/jquery.ajaxchimp.min.js"></script>
<script src="/maintainance/js/plugins/photoswipe/photoswipe.min.js"></script>
<script src="/maintainance/js/plugins/photoswipe/photoswipe-ui-default.min.js"></script>
<script src="/maintainance/js/plugins/jquery.countdown.min.js"></script>
<script src="/maintainance/js/plugins/prefixfree.min.js"></script>

<!-- Custom Script -->
<script src="/maintainance/js/custom.js"></script>


<!-- Google Analytics -->
<script>
  

</script>

</body>
</html>
