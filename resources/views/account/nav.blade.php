

<div class="sidebar-overlay"></div>
<div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
<aside class="sidebar-shop  order-lg-first mobile-sidebar">
   <div class="pin-wrapper" style="">
      <div class="sidebar-wrapper" style="">
        <h2 class="">Dashboard</h2>

        <div class="list-group">
            <a href="/account" class="list-group-item list-group-item-action text-uppercase bold p-4"><i class="fa fa-user-circle"></i> Account</a>
            <a href="/change/password" class="list-group-item list-group-item-action text-uppercase  bold p-4"><i class="fa fa-edit"></i> Change Password</a>
            <a href="/orders"          class="list-group-item list-group-item-action text-uppercase bold p-4"><i class="fa fa-shopping-cart"></i> Orders</a>
            <a href="/address"         class="list-group-item list-group-item-action  text-uppercase bold p-4"><i class="fa fa-map-marker"></i> Shipping Addresses</a>
            <a href="#" 
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    class="list-group-item list-group-item-action bold text-uppercase p-4"><i class="fas fa-sign-out-alt left"></i> Logout
                    
                    
                <form id="logout-form" action="/fashion/logout" method="POST" style="display: none;">
                    @csrf
                </form>      
            </a>
        </div>
        </div>
   </div>
</aside>
<!-- End .col-lg-3 -->

