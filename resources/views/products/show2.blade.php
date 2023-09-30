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

    <div class="product-single-container products-show product-single-default product-center-vertical">
        <div class="cart-message d-none">
            <strong class="single-cart-notice">“Men Black Sports Shoes”</strong>
            <span>has been added to your cart.</span>
        </div>

        <div class="row custom-single-default">

            <div class="prod-thum col-lg-1" id='custom-carousel-dots'>

                @foreach($product->images as $image)
                <div class="th border">
                    <img src="{{ $image->image_m }}" width="110" height="110" alt="product-thumbnail" />
                </div>
                @endforeach
            </div>
            <div class="col-lg-6  d-lg-flex justify-content-center align-items-center order-0 order-lg-0">
                <div class="d-flex flex-column  custom-single-carousel">
                    @foreach($product->images as $image)
                    <div class="product-item border">
                        <img class="product-single-image" src="{{ $image->image_l }}" alt="product" />
                    </div>
                    @endforeach
                    <!-- End .product-single-carousel -->
                </div>


            </div>

            <show :product="{{ $product }}" />

        </div>
    </div>
    <!-- End .product-single-container -->

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
        <div class="accordion accordion-flush" id="accordionNav">

            <div class="accordion-item">
                <h2 class="accordion-header border-bottom  mb-0 py-3 bold" id="flush-heading2">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                        PRODUCT DESCRIPTION
                    </button>
                </h2>
                <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionNav">
                    <div class="accordion-body">
                        <?php echo html_entity_decode($product->description) ?>
                    </div>
                </div>
                <h2 class="border-bottom accordion-header mb-0 py-3 bold" id="flush-heading1">
                    <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                        PRODUCT SPECIFICATIONS
                    </button>
                </h2>
                <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionNav">
                    <div class="accordion-body">

                        <div class="product-desc">
                            <?php echo html_entity_decode($product->phy_desc) ?>
                        </div>

                    </div>
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
                <div class="product-default  p d-flex flex-column justify-content-center align-items-center px-2">
                    <a class="d-block" href="{{$related_product->product->link }}">
                        <img src="{{ $related_product->product->image_m }}" alt="product">
                    </a>
                    <div class="label-group">
                        <!-- <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">-20%</div> -->
                    </div>
                </div>

                <div class="product-details">


                    <h6 class="fs-5"> <a href="{{$related_product->product->link }}">{{ $related_product->product->name }}</a> </h6>

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