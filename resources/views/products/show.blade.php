@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/products/{{ $category_slug }}">{{ $category }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="product-single-container product-single-default">
        <div class="row">
            <div class="col-lg-1">
                <div class="prod-thumbnail owl-dots flex-column">
                    @foreach($product->images as $image)
                    <div class="owl-dot mb-2">
                        <img src="{{ $image->image_m }}" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-lg-6  product-single-gallery">
                <div class="product-slider-container">
                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                        @foreach($product->images as $image)
                        <div class="product-item">
                            <img class="product-single-image" src="{{ $image->image_l }}" width="468" height="468" alt="product" />
                        </div>
                        @endforeach
                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
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

    <div class="container-fluid d-sm-block d-lg-none p-0">
        <div class="mt-1" id="accordion1">
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

    <div class="container-fluid my-5">
        <div class="row">
            <h3 class="mb-0">
                Reviews
            </h3>
            <reviews :user="{{ $user }}" :product="{{ $product }}" />
        </div>
    </div>

    @if ( optional($product->related_products)->count() )
    <div class="products-section container-fluid pt-0 mt-4">
        <h2 class="section-title">Related Products</h2>
        <div class="products-slider owl-carousel owl-theme dots-top dots-small">
            @foreach( $product->related_products as $related_product)
            <div class="product-default">
                <figure>
                    <a href="{{$related_product->product->link }}">
                        <img src="{{ $related_product->product->image_m }}" width="280" height="280" alt="product">
                        <img src="{{ $related_product->product->image_m }}" width="280" height="280" alt="product">
                    </a>
                    <div class="label-group">
                        <!-- <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">-20%</div> -->
                    </div>
                </figure>
                <div class="product-details">


                    <h3 class="product-title"> <a href="{{$related_product->product->link }}">{{ $related_product->product->name }}</a> </h3>

                    <div class="ratings-container">
                        @include('_partials.ratings')
                    </div>
                    <!-- End .product-container -->
                    <div class="price-box">
                        @if($related_product->product->discounted_price)
                        <div>
                            <span class="old-price">{{ $related_product->product->currency }}{{ $related_product->product->formatted_sale_price }}</span>
                            <span class="product-price">{{ $related_product->product->currency }}{{ $related_product->product->formatted_price }}</span>
                        </div>
                        @else
                        <div>
                            <span class="product-price">{{ $related_product->product->currency }}{{ $related_product->product->formatted_price }}</span>
                        </div>
                        @endif
                    </div>
                    <!-- End .price-box -->

                </div>
                <!-- End .product-details -->
            </div>
            @endforeach






        </div>
        <!-- End .products-slider -->
    </div>
    @endif
    @endsection