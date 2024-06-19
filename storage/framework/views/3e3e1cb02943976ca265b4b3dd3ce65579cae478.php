<?php $__env->startSection('content'); ?>

<section class="my-5">
    <div class="container">
        <div class="d-block d-sm-none">
            <?php echo $__env->make('_partials.mobile_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="container ">
        <div class="row">

            <?php echo $__env->make('_partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9 bg--light  pb-3">
                <h2 class="page-title">Your Order</h2>
                <section class="top mb-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <h3>Shipping Address</h3>
                                <span id=""><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></span>
                                <br /><?php echo e($order->address); ?>

                                <br /> <?php echo e($order->city); ?> &nbsp;
                                <br /> <?php echo e($order->state); ?>

                                <br /> <b>Email: </b><?php echo e($order->email); ?>


                                <br /> <b>Phone Number: </b> <?php echo e($order->phone_number); ?>


                                </span>
                            </div>
                            <div class="col-4">
                                <h3>Payment Method</h3>
                                <?php echo e(ucfirst(str_replace("_", " ", $order->payment_type))); ?>

                            </div>

                            <div class="col-4">
                                <h3>Cart Total</h3>
                                <span><span class="bold" id="subtotal">Subtotal:</span> ₦<?php echo e($total); ?></span></span> </br>
                                <span><span class="bold" id="subtotal">Shipping:</span> ₦<?php echo e($order->ship_price); ?></span></span> </br>
                                <span><span class="bold" id="subtotal">Coupon:</span> <?php echo e($coupon ?? '---'); ?></span></span> </br>

                                <span><span class="bold" id="total">Total:</span> ₦<?php echo e($order->get_total()); ?> </span>
                            </div>
                        </div>
                    </div>

                </section>
                <!--Breadcrumb-->

                <div class="card card-plain mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-left" scope="col">Order Date: <?php echo e($order->created_at->format('m/d/Y')); ?></th>
                                        <th colspan="1" class="text-right" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $order->ordered_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><span class="bold">Status:</span> <?php echo e($order->status); ?></th>
                                        <td colspan="3">
                                            <div class="media">
                                                <div class="image-category">
                                                    <img class="align-self-start mr-3 img-fluid" src="<?php echo e(optional($order_product->product)->image_m); ?> " alt="<?php echo e(optional($order_product->product)->name); ?>">
                                                </div>
                                                <div class="media-body ml-3 ">
                                                    <div class="font-weight-bolder">
                                                        <p class="font-weight-bolder"><span class="bold">Name: </span> <?php echo e($order_product->product_name); ?></span>
                                                        <p class="font-weight-bolder"><span class="bold">Quantity: </span> <?php echo e($order_product->quantity); ?></span>
                                                        <p class="font-weight-bolder"><span class="bold">Price: &nbsp;</span> ₦<?php echo e(number_format($order_product->price)); ?></p>

                                                    </div>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--End Contact Form & Info-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/orders/show.blade.php ENDPATH**/ ?>