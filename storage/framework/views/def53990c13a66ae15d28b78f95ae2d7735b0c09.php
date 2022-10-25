<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="product-transparent-image.html#">Products</a></li>
        </ol>
    </nav>
</div>

<div class="product-single-container product-single-default product-transparent-image bg-gray">
    <div class="container">


        <div class="row">
            <div class="col-xl-7">
                <div class="product-single-gallery pg-vertical">
                    <div class="product-slider-container">
                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="product-item">
                                <img class="product-single-image" src="<?php echo e($image->image); ?>" data-zoom-image="<?php echo e($image->image); ?>" width="540" height="540" alt="product-img" />
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="vertical-thumbs">
                        <button class="thumb-up disabled"><i class="icon-angle-up"></i></button>
                        <div class="product-thumbs-wrap">
                            <div class="product-thumbs owl-dots" id='carousel-custom-dots'>
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="owl-dot">
                                    <img src="<?php echo e($image->image); ?>" width="128" height="128" alt="<?php echo e($product->name); ?>" />
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </div>
                        </div>
                        <button class="thumb-down disabled"><i class="icon-angle-down"></i></button>
                    </div>
                </div>
            </div>
            <!-- End .product-single-gallery -->

            <show :product="<?php echo e($product); ?>" />
        </div>
        <!-- End .row -->
    </div>
</div>
<!-- End .product-single-container -->

<div class="container">
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


    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"> Accordion Item #1 </button></h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"> Accordion Item #2 </button></h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
            </div>
        </div>

    </div>
    <!-- End .product-single-collapse -->




</div>
<!-- End .container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/products/show.blade.php ENDPATH**/ ?>