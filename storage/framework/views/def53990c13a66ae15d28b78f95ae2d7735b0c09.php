<?php $__env->startSection('content'); ?>

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
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="product-item">
                            <img class="product-single-image" src="<?php echo e($image->image); ?>" data-zoom-image="<?php echo e($image->image); ?>" width="468" height="468" alt="product" />
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                    <!-- End .product-single-carousel -->
                    <span class="prod-full-screen">
                        <i class="icon-plus"></i>
                    </span>
                </div>

                <div class="prod-thumbnail owl-dots">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="owl-dot">
                        <img src="<?php echo e($image->image); ?>" width="110" height="110" alt="product-thumbnail" />
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

    <div class="container-fluid  p-0">
        <h3>
            Reviews
        </h3>
        <div class="product-reviews-content">
            <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

            <div class="comment-list">
                <div class="comments">
                    <figure class="img-thumbnail">
                        <img src="assets/images/blog/author.jpg" alt="author" width="80" height="80">
                    </figure>

                    <div class="comment-block">
                        <div class="comment-header">
                            <div class="comment-arrow"></div>

                            <div class="ratings-container float-sm-right">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:60%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>

                            <span class="comment-by">
                                <strong>Joe Doe</strong> – April 12, 2018
                            </span>
                        </div>

                        <div class="comment-content">
                            <p>Excellent.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="add-product-review">
                <h3 class="review-title">Add a review</h3>

                <form action="#" class="comment-form m-0">
                    <div class="rating-form">
                        <label for="rating">Your rating <span class="required">*</span></label>
                        <span class="rating-stars">
                            <a class="star-1" href="product.html#">1</a>
                            <a class="star-2" href="product.html#">2</a>
                            <a class="star-3" href="product.html#">3</a>
                            <a class="star-4" href="product.html#">4</a>
                            <a class="star-5" href="product.html#">5</a>
                        </span>

                        <select name="rating" id="rating" required="" style="display: none;">
                            <option value="">Rate…</option>
                            <option value="5">Perfect</option>
                            <option value="4">Good</option>
                            <option value="3">Average</option>
                            <option value="2">Not that bad</option>
                            <option value="1">Very poor</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Your review <span class="required">*</span></label>
                        <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                    </div>
                    <!-- End .form-group -->


                    <div class="row">
                        <div class="col-md-6 col-xl-12">
                            <div class="form-group">
                                <label>Name <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-sm" required>
                            </div>
                            <!-- End .form-group -->
                        </div>

                        <div class="col-md-6 col-xl-12">
                            <div class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="text" class="form-control form-control-sm" required>
                            </div>
                            <!-- End .form-group -->
                        </div>

                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-name" />
                                <label class="custom-control-label mb-0" for="save-name">Save my
                                    name, email, and website in this browser for the next time I
                                    comment.</label>
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
            <!-- End .add-product-review -->
        </div>
    </div>

    <?php if( optional($product->related_products)->count() ): ?>

    <div class="products-section container-fluid pt-0 mt-4">
        <h2 class="section-title">Related Products</h2>


        <div class="products-slider owl-carousel owl-theme dots-top dots-small">
            <?php $__currentLoopData = $product->related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-default">
                <figure>
                    <a href="product.html">
                        <img src="<?php echo e($product->image_to_show); ?>" width="280" height="280" alt="product">
                        <img src="<?php echo e($product->image_to_show); ?>" width="280" height="280" alt="product">
                    </a>
                    <div class="label-group">
                        <!-- <div class="product-label label-hot">HOT</div>
                        <div class="product-label label-sale">-20%</div> -->
                    </div>
                </figure>
                <div class="product-details">


                    <h3 class="product-title"> <a href="<?php echo e($product->link); ?>"><?php echo e($product->name); ?></a> </h3>

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
                        <?php if($product->discounted_price): ?>
                        <div>
                            <span class="old-price"><?php echo e($product->currency); ?><?php echo e($product->formatted_sale_price); ?></span>
                            <span class="product-price"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
                        </div>
                        <?php else: ?>
                        <div>
                            <span class="product-price"><?php echo e($product->currency); ?><?php echo e($product->formatted_price); ?></span>
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