@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="product.html#">Products</a></li>
        </ol>
    </nav>

    <div class="product-single-container product-single-default">


        <div class="row">
            <div class="col-lg-7  product-single-gallery">
                <div class="product-slider-container">


                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                        @foreach($product->images as $image)

                        <div class="product-item">
                            <img class="product-single-image" src="{{ $image->image }}" data-zoom-image="{{ $image->image }}" width="468" height="468" alt="product" />
                        </div>
                        @endforeach


                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
                </div>

                <div class="prod-thumbnail owl-dots">
                    @foreach($product->images as $image)

                    <div class="owl-dot">
                        <img src="{{ $image->image }}" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    @endforeach


                </div>
            </div>
            <!-- End .product-single-gallery -->

            <show :product="{{ $product }}" />

            <!-- End .product-single-details -->
        </div>
        <!-- End .row -->
    </div>
    <div class="container-fluid  d-none d-lg-block">
        <div class="row">
            <div class="col-md-6">
                <div class="header">
                    <h2>
                        PRODUCT SPECIFICATIONS
                    </h2>
                    <div class="product-desc">
                        <?php echo html_entity_decode($product->phy_desc) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="header">
                    <h2>
                        PRODUCT DESCRIPTION
                    </h2>
                    <?php echo html_entity_decode($product->description) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-sm-block d-lg-none">
        <div class="mt-8" id="accordion1">
            <div class="card card-accordion">
                <a class="card-header collapsed" href="element-accordions.html#" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                    PRODUCT SPECIFICATIONS
                </a>

                <div id="collapse1" class="collapse" data-parent="#accordion1" style="">
                    <?php echo html_entity_decode($product->phy_desc) ?>

                </div>
            </div>

            <div class="card card-accordion">
                <a class="card-header collapsed" href="element-accordions.html#" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    PRODUCT DESCRIPTION

                </a>

                <div id="collapse2" class="collapse" data-parent="#accordion1" style="">
                    <?php echo html_entity_decode($product->description) ?>

                </div>
            </div>


        </div>





    </div>
    <!-- End .container -->

    <div class="products-section pt-0">
        <h2 class="section-title">Related Products</h2>

        <div class="products-slider owl-carousel owl-theme dots-top dots-small">
            <div class="product-default">
                <figure>
                    <a href="product.html">
                        <img src="assets/images/products/product-1.jpg" width="280" height="280" alt="product">
                        <img src="assets/images/products/product-1-2.jpg" width="280" height="280" alt="product">
                    </a>
                    <div class="label-group">
                        <!-- <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">-20%</div> -->
                    </div>
                </figure>
                <div class="product-details">
                    <div class="category-list">
                        <a href="category.html" class="product-category">Category</a>
                    </div>
                    <h3 class="product-title">
                        <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->
                    </div>
                    <!-- End .product-container -->
                    <div class="price-box">
                        <del class="old-price">$59.00</del>
                        <span class="product-price">$49.00</span>
                    </div>
                    <!-- End .price-box -->
                    <div class="product-action">
                        <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                        <a href="product.html" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT
                                OPTIONS</span></a>
                        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
                <!-- End .product-details -->
            </div>






        </div>
        <!-- End .products-slider -->
    </div>
    @endsection