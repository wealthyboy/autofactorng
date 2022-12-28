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
                        <img src="{{ $image->image_m }}" width="110" height="110" alt="product-thumbnail" />
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
    <div class="container-fluid">
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
    <!-- End .container -->
    @endsection