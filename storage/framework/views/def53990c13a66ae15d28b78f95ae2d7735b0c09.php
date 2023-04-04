<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/products/<?php echo e($category_slug); ?>"><?php echo e($category); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
        </ol>
    </nav>

    <div class="product-single-container products-show product-single-default">
        <div class="row">
            <div class="col-lg-1 d-none d-lg-block d-xl-block">
                <div class="prod-thumbnail owl-dots flex-column">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="owl-dot mb-2">
                        <img src="<?php echo e($image->image_m); ?>" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
            <div class="col-lg-6  col-12 product-single-gallery">
                <div class="product-slider-container">
                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product-item">
                            <img class="product-single-image" src="<?php echo e($image->image); ?>" width="468" height="468" alt="product" />
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
                </div>

                <div class="prod-thumbnail owl-dots d-block d-sm-none">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="owl-dot mb-2">
                        <img src="<?php echo e($image->image_m); ?>" width="110" height="110" alt="product-thumbnail" />
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>


            </div>
            <!-- End .product-single-gallery -->

            <show :product="<?php echo e($product); ?>" />

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
            <reviews :user="<?php echo e($user); ?>" :product="<?php echo e($product); ?>" />
        </div>
    </div>

    <?php if( optional($product->related_products)->count() ): ?>
    <div class="products-section container-fluid pt-0 mt-4">
        <h2 class="section-title">Related Products</h2>
        <div class="products-slider owl-carousel owl-theme dots-top dots-small">
            <?php $__currentLoopData = $product->related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-default">
                <figure>
                    <a href="<?php echo e($related_product->product->link); ?>">
                        <img src="<?php echo e($related_product->product->image_m); ?>" width="280" height="280" alt="product">
                        <img src="<?php echo e($related_product->product->image_m); ?>" width="280" height="280" alt="product">
                    </a>
                    <div class="label-group">
                        <!-- <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">-20%</div> -->
                    </div>
                </figure>
                <div class="product-details">


                    <h3 class="product-title"> <a href="<?php echo e($related_product->product->link); ?>"><?php echo e($related_product->product->name); ?></a> </h3>

                    <div class="ratings-container">
                        <?php echo $__env->make('_partials.ratings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- End .product-container -->
                    <div class="price-box">
                        <?php if($related_product->product->discounted_price): ?>
                        <div>
                            <span class="old-price"><?php echo e($related_product->product->currency); ?><?php echo e($related_product->product->formatted_sale_price); ?></span>
                            <span class="product-price"><?php echo e($related_product->product->currency); ?><?php echo e($related_product->product->formatted_price); ?></span>
                        </div>
                        <?php else: ?>
                        <div>
                            <span class="product-price"><?php echo e($related_product->product->currency); ?><?php echo e($related_product->product->formatted_price); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- End .price-box -->

                </div>
                <!-- End .product-details -->
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>






        </div>
        <!-- End .products-slider -->
    </div>
    <?php endif; ?>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/products/show.blade.php ENDPATH**/ ?>