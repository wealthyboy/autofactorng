<div class="offcanvas  nav-categories offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Shop All</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
        <ul class="list-unstyled pl-3">
            <?php $__currentLoopData = $global_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e($category->link ? $category->link : '/products/'.$category->slug); ?>" target="" data-testid="at_popular_part_list_item_0" tabindex="0">
                    <div class="az_ylb">
                        <div class="az_bdb az_lkb az_zlb" tabindex="-1" role="menuitem" aria-disabled="false">
                            <div class="az_-i"><?php echo e($category->name); ?></div>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <nav class="main-nav w-100">
            <ul class="menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
                <li>
                    <a href="demo4.html">Home</a>
                </li>
                <li>
                    <a href="category.html" class="sf-with-ul">Categories</a>
                    <div class="megamenu megamenu-fixed-width megamenu-3cols" style="display: none; left: -15px;">
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="product.html#" class="nolink">VARIATION 1</a>
                                <ul class="submenu">
                                    <li><a href="category.html">Fullwidth Banner</a></li>
                                    <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a>
                                    </li>
                                    <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a>
                                    </li>
                                    <li><a href="category.html">Left Sidebar</a></li>
                                    <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                    <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                                    <li><a href="category-horizontal-filter1.html">Horizontal Filter1</a>
                                    </li>
                                    <li><a href="category-horizontal-filter2.html">Horizontal Filter2</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <a href="product.html#" class="nolink">VARIATION 2</a>
                                <ul class="submenu">
                                    <li><a href="category-list.html">List Types</a></li>
                                    <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a>
                                    </li>
                                    <li><a href="category.html">3 Columns Products</a></li>
                                    <li><a href="category-4col.html">4 Columns Products</a></li>
                                    <li><a href="category-5col.html">5 Columns Products</a></li>
                                    <li><a href="category-6col.html">6 Columns Products</a></li>
                                    <li><a href="category-7col.html">7 Columns Products</a></li>
                                    <li><a href="category-8col.html">8 Columns Products</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4 p-0">
                                <div class="menu-banner">
                                    <figure>
                                        <img src="assets/images/menu-banner.jpg" width="192" height="313" alt="Menu banner">
                                    </figure>
                                    <div class="banner-content">
                                        <h4>
                                            <span class="">UP TO</span><br>
                                            <b class="">50%</b>
                                            <i>OFF</i>
                                        </h4>
                                        <a href="category.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .megamenu -->
                </li>
                <li class="active">
                    <a href="product.html" class="sf-with-ul">Products</a>
                    <div class="megamenu megamenu-fixed-width" style="display: none; left: -15px;">
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="product.html#" class="nolink">PRODUCT PAGES</a>
                                <ul class="submenu">
                                    <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                    <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                    <li><a href="product.html">SALE PRODUCT</a></li>
                                    <li><a href="product.html">FEATURED &amp; ON SALE</a></li>
                                    <li><a href="product-custom-tab.html">WITH CUSTOM TAB</a></li>
                                    <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                    <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                    <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                </ul>
                            </div>
                            <!-- End .col-lg-4 -->

                            <div class="col-lg-4">
                                <a href="product.html#" class="nolink">PRODUCT LAYOUTS</a>
                                <ul class="submenu">
                                    <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                    <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                    <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                    <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                    <li><a href="product-sticky-both.html">LEFT &amp; RIGHT STICKY</a></li>
                                    <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a></li>
                                    <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                    <li><a href="product.html#">BUILD YOUR OWN</a></li>
                                </ul>
                            </div>
                            <!-- End .col-lg-4 -->

                            <div class="col-lg-4 p-0">
                                <div class="menu-banner menu-banner-2">
                                    <figure>
                                        <img src="assets/images/menu-banner-1.jpg" width="182" height="317" alt="Menu banner" class="product-promo">
                                    </figure>
                                    <i>OFF</i>
                                    <div class="banner-content">
                                        <h4>
                                            <span class="">UP TO</span><br>
                                            <b class="">50%</b>
                                        </h4>
                                    </div>
                                    <a href="category.html" class="btn btn-sm btn-dark">SHOP NOW</a>
                                </div>
                            </div>
                            <!-- End .col-lg-4 -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .megamenu -->
                </li>
                <li class="">
                    <a href="product.html#" class="sf-with-ul">Pages</a>
                    <ul style="display: none;">
                        <li><a href="wishlist.html">Wishlist</a></li>
                        <li><a href="cart.html">Shopping Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li class=""><a href="product.html#" class="sf-with-ul">Blog</a>
                            <ul style="display: none;">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single.html">Blog Post</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="forgot-password.html">Forgot Password</a></li>
                    </ul>
                </li>
                <li><a href="blog.html">Blog</a></li>
                <li class="">
                    <a href="product.html#" class="sf-with-ul">Elements</a>
                    <ul class="custom-scrollbar" style="display: none;">
                        <li><a href="element-accordions.html">Accordion</a></li>
                        <li><a href="element-alerts.html">Alerts</a></li>
                        <li><a href="element-animations.html">Animations</a></li>
                        <li><a href="element-banners.html">Banners</a></li>
                        <li><a href="element-buttons.html">Buttons</a></li>
                        <li><a href="element-call-to-action.html">Call to Action</a></li>
                        <li><a href="element-countdown.html">Count Down</a></li>
                        <li><a href="element-counters.html">Counters</a></li>
                        <li><a href="element-headings.html">Headings</a></li>
                        <li><a href="element-icons.html">Icons</a></li>
                        <li><a href="element-info-box.html">Info box</a></li>
                        <li><a href="element-posts.html">Posts</a></li>
                        <li><a href="element-products.html">Products</a></li>
                        <li><a href="element-product-categories.html">Product Categories</a></li>
                        <li><a href="element-tabs.html">Tabs</a></li>
                        <li><a href="element-testimonial.html">Testimonials</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact Us</a></li>
                <li class="float-right"><a href="https://1.envato.market/DdLk5" class="pl-5" target="_blank">Buy Porto!</a></li>
                <li class="float-right"><a href="product.html#" class="pl-5">Special Offer!</a></li>
            </ul>
        </nav>
    </div>

</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/_partials/nav_categories.blade.php ENDPATH**/ ?>