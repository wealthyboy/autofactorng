@inject('helper', 'App\Http\Helper')

<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8" />
    
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Config('app.name')}} | Admin</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
        <!-- Favicone Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
	<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="icon" type="image/png" href="/img/favicon-96x96.png">
	<link rel="apple-touch-icon" href="/img/favicon-96x96.png">

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />



	<!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"/>
    @yield('page-styles')
</head>


<body class="g-sidenav-show bg-gray-200">
      <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
         <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="/" target="_blank">
            <span class="ms-1 font-weight-bold text-white">{{  Config('app.name')  }}</span>
            </a>
         </div>
         <hr class="horizontal light mt-0 mb-2">
         <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
               <li class="nav-item mb-2 mt-0">
                  <a  href="#" class="nav-link text-white" >
                     
                  <span class="nav-link-text ms-2 ps-1">
                     @if (Auth::check() )
                       {{ Auth::user()->name }}
                     @else
                     <i class="fa-solid fa-truck-fast"></i> I'm in
                     @endif
                  </span>
                  </a>
                  
               </li>
               <hr class="horizontal light mt-0">
               <li class="nav-item ">
                  <a href="/admin" class="nav-link text-white "  role="button">
                  <i class="material-symbols-outlined opacity-10">dashboard</i>
                  <span class="nav-link-text ms-2 ps-1">Dashboard</span>
                  </a>
                 
               </li>

               <li class="nav-item">
                  <a class="nav-link text-white   $helper->active_link(['maintainance']) }}"  href="{{ route('maintainance') }}">
                    <i class="material-symbols-outlined">power_settings_new</i>

                     <span class="nav-link-text ms-2 ps-1">  Disable/Enable Site </span>
                  </a>
               </li>
               <li class=" nav-item">
                  <a class="nav-link text-white {{ $helper->active_link(['activities']) }}" href="/admin/activities">
                  <i class="material-symbols-outlined">browse_activity</i>
       
   
                  <span class="nav-link-text ms-2 ps-1"> Activity </span>

                  </a>
               </li>
               <li class=" nav-item">
                  <a class="nav-link text-white {{ $helper->active_link(['reports']) }}" href="/admin/reports">
                  <i class="material-symbols-outlined opacity-10">show_chart</i>
      
                  <span class="nav-link-text ms-2 ps-1"> Reports </span>
                  </a>
               </li>


               <li class="nav-item">
                  <a data-bs-toggle="collapse" href="settings.html#ecommerceExamples" class="nav-link text-white {{ $helper->active_link(['reviews','brands','products','category','discounts','attributes','vouchers']) }}" aria-controls="ecommerceExamples" role="button" aria-expanded="false">
                  <i class="material-symbols-outlined">inventory_2</i>
                  <span class="nav-link-text ms-2 ps-1">Products</span>
                  </a>
                  <div class="collapse  {{ $helper->active_link(['brands','engines','products','reviews','category','discounts','attributes','vouchers']) ? 'show' : ''}}" id="ecommerceExamples">
                     <ul class="nav ">

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['attributes']) }}"  href="{{ route('attributes.index') }}">
                              <span class="sidenav-mini-icon"> C </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Attributes <b class="caret"></b></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['brands']) }}"  href="{{ route('brands.index') }}">
                              <span class="sidenav-mini-icon"> C </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Brands <b class="caret"></b></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['discounts']) }}"  href="{{ route('discounts.index') }}">
                              <span class="sidenav-mini-icon"> C </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Discounts <b class="caret"></b></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white  {{ $helper->active_link(['category']) }}"  href="{{ route('category.index') }}">
                              <span class="sidenav-mini-icon"> C </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Categories <b class="caret"></b></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['engines']) }}"  href="{{ route('engines.index') }}">
                              <span class="sidenav-mini-icon"> E </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Engines <b class="caret"></b></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['products']) }}"  href="{{ route('products.index') }}">
                              <span class="sidenav-mini-icon"> P </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Products <b class="caret"></b></span>
                           </a>
                        </li>
                        
                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['vouchers']) }}"  href="{{ route('vouchers.index') }}">
                              <span class="sidenav-mini-icon"> C </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Vouchers <b class="caret"></b></span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['reviews']) }}"  href="/admin/reviews">
                              <span class="sidenav-mini-icon"> R </span>
                              <span class="sidenav-normal  ms-2  ps-1"> Reviews <b class="caret"></b></span>
                           </a>
                        </li>

      
                     </ul>
                  </div>
               </li>

               <li class=" nav-item">
                  <a class="nav-link text-white {{ $helper->active_link(['orders']) }}" href="{{ route('admin.orders.index') }}">
                     <i class="material-symbols-outlined opacity-10">shopping_cart</i>
                     <span class="nav-link-text ms-2 ps-1"> Orders </span>
                  </a>
               </li>

      

                 
               <li class="nav-item">
                  <a data-bs-toggle="collapse" href="a#Users" class="nav-link text-white  {{ $helper->active_link(['users','customers']) }}" aria-controls="Users" role="button" aria-expanded="false">
                  <i class="material-symbols-outlined">manage_accounts</i>
                  <span class="nav-link-text ms-2 ps-1">Users</span>
                  </a>
                  <div class="collapse   {{ $helper->active_link(['users','customers']) ? 'show' : ''}}" id="Users">
                     <ul class="nav ">
                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['users']) }}" href="{{ route('admin.users.index') }}">
                           <span class="sidenav-mini-icon"> S </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Admin </span>
                           </a>
                        </li>
                        <li class="nav-item ">
                           <a class="nav-link text-white  {{ $helper->active_link(['customers']) }}" href="/admin/customers">
                           <span class="sidenav-mini-icon"> B </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Customers </span>
                           </a>
                        </li>
                                             
                     </ul>
                  </div>
               </li>
               
               
               
               <li class="nav-item">
                  <a data-bs-toggle="collapse" href="a#design" class="nav-link text-white  {{ $helper->active_link(['banners','pages','promos']) }}" aria-controls="design" role="button" aria-expanded="false">
                  <i class="material-symbols-outlined">padding</i>
                  <span class="nav-link-text ms-2 ps-1">Design</span>
                  </a>
                  <div class="collapse {{ $helper->active_link(['banners','pages','promos']) ? 'show' : '' }}" id="design">
                     <ul class="nav ">
                       
                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['banners']) }}" href="{{ route('banners.index') }}">
                           <span class="sidenav-mini-icon"> B </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Banners </span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['pages']) }}" href="{{ route('pages.index') }}" >
                           <span class="sidenav-mini-icon"> P </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Pages </span>
                           </a>
                        </li>

                        <li class="nav-item ">
                           <a class="nav-link text-white {{ $helper->active_link(['promos']) }}" href="{{ route('promos.index') }}" >
                           <span class="sidenav-mini-icon"> P </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Promo Text </span>
                           </a>
                        </li>                   
                     </ul>
                  </div>
               </li>
               
               <li class="nav-item mb-5">
                  <a data-bs-toggle="collapse" href="a#settings" class="nav-link text-white  {{ $helper->active_link(['settings','permissions','location']) }}" aria-controls="settings" role="button" aria-expanded="false">
                  <i class="material-symbols-outlined">settings</i>
                  <span class="nav-link-text ms-2 ps-1">Settings</span>
                  </a>
                  <div class="collapse   {{ $helper->active_link(['settings','permissions','location', 'shipping']) ? 'show' : '' }}" id="settings">
                     <ul class="nav ">
                        <li class="nav-item ">
                           <a class="nav-link text-white  {{ $helper->active_link(['settings']) }}" href="{{ route('settings.index') }}">
                           <span class="sidenav-mini-icon"> S </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Settings </span>
                           </a>
                        </li>
                        <li class="nav-item ">
                           <a class="nav-link text-white  {{ $helper->active_link(['permissions']) }}" href="{{ route('permissions.index') }}">
                           <span class="sidenav-mini-icon"> P </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Permissions </span>
                           </a>
                        </li>
                        <li class="nav-item ">
                           <a class="nav-link text-white  {{ $helper->active_link(['location']) }}" href="{{ route('location.index') }}">
                           <span class="sidenav-mini-icon"> P </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Location </span>
                           </a>
                        </li>
                        
                        <li class="nav-item ">
                           <a class="nav-link text-white   {{ $helper->active_link(['shipping']) }}" href="{{ route('shipping.index') }}" >
                           <span class="sidenav-mini-icon"> S </span>
                           <span class="sidenav-normal  ms-2  ps-1"> Shipping </span>
                           </a>
                        </li>
                                             
                     </ul>
                  </div>
               </li>

               <li class="mt-5"></li>
            </ul>
         </div>
      </aside>
      <main class="main-content max-height-vh-100 h-100">
      <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 border-radius-xl z-index-sticky shadow-none" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
               <li class="breadcrumb-item text-sm">
                  <a class="opacity-3 text-dark" href="javascript:;">
                     <svg width="12px" height="12px" class="mb-1" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>shop </title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <g transform="translate(-1716.000000, -439.000000)" fill="#252f40" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                 <g transform="translate(0.000000, 148.000000)">
                                    <path d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                    <path d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                 </g>
                              </g>
                           </g>
                        </g>
                     </svg>
                  </a>
               </li>
               <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
               <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{  request()->path() }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ request()->path() }}</h6>
         </nav>
         <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
            <a href="javascript:;" class="nav-link p-0 text-body">
               <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
               </div>
            </a>
         </div>
         <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
               <div class="input-group input-group-outline">
                  <label class="form-label">Search here</label>
                  <input type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
               </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
               <li class="nav-item">
                  <a href="/" class="nav-link p-0 position-relative text-body" target="_blank">
                  <i class="material-symbols-outlined">account_circle</i>
                  </a>
               </li>
               <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                  <a href="javascript:;" class="nav-link p-0 text-body" id="iconNavbarSidenav">
                     <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                     </div>
                  </a>
               </li>
               <li class="nav-item px-3">
                  <a href="javascript:;" class="nav-link p-0 text-body">
                  <i class="material-symbols-outlined fixed-plugin-button-nav cursor-pointer">settings </i>
                  </a>
               </li>
               <li class="nav-item dropdown pe-2">
                  <a href="javascript:;" class="nav-link p-0 position-relative text-body" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  
                  <i class="material-symbols-outlined cursor-pointer">notifications</i>
                  <span class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger border border-white small py-1 px-2">
                  <span class="small">0</span>
                  <span class="visually-hidden">unread notifications</span>
                  </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                  
                     <li>
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                           <div class="d-flex align-items-center py-1">
                              <div class="ms-2">
                                 <h6 class="text-sm font-weight-normal my-auto">
                                    Payment successfully completed
                                 </h6>
                              </div>
                           </div>
                        </a>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
   </nav>
         <div class="container-fluid py-4">
            @yield('content')
         
            <footer class="footer py-4  ">
               <div class="container-fluid">
                  <div class="row align-items-center justify-content-lg-between">
                     <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                           © <script>
                              document.write(new Date().getFullYear())
                           </script>,
                           <a href="/" class="font-weight-bold" target="_blank">{{ Config('app.name')}} </a>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </footer>
         </div>
      </main>
      <div class="fixed-plugin">
         <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
         <i class="material-symbols-outlined py-2">settings</i>
         </a>
         <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
               <div class="float-start">
                  <h5 class="mt-3 mb-0">{{  Config('app.name')  }}</h5>
                  <p>dashboard options.</p>
               </div>
               <div class="float-end mt-4">
                  <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                  <i class="material-symbols-outlined">close</i>
                  </button>
               </div>
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
               <div>
                  <h6 class="mb-0">Sidebar Colors</h6>
               </div>
               <a href="javascript:void(0)" class="switch-trigger background-color">
                  <div class="badge-colors my-2 text-start">
                     <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                     <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                     <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                     <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                     <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                     <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                  </div>
               </a>
               <div class="mt-3">
                  <h6 class="mb-0">Sidenav Type</h6>
                  <p class="text-sm">Choose between 2 different sidenav types.</p>
               </div>
               <div class="d-flex">
                  <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                  <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                  <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
               </div>
               <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
               <div class="mt-3 d-flex">
                  <h6 class="mb-0">Navbar Fixed</h6>
                  <div class="form-check form-switch ps-0 ms-auto my-auto">
                     <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                  </div>
               </div>
               <hr class="horizontal dark my-3">
               <div class="mt-2 d-flex">
                  <h6 class="mb-0">Sidenav Mini</h6>
                  <div class="form-check form-switch ps-0 ms-auto my-auto">
                     <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarMinimize" onclick="navbarMinimize(this)">
                  </div>
               </div>
               <hr class="horizontal dark my-3">
               <div class="mt-2 d-flex">
                  <h6 class="mb-0">Light / Dark</h6>
                  <div class="form-check form-switch ps-0 ms-auto my-auto">
                     <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      <script src="/js/dashboard.js"></script>
      @yield('page-scripts')
      <script type="text/javascript">
         @yield('inline-scripts')
      </script>
   </body>
  

</html>
