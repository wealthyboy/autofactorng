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

            <div class="col-md-9">
                <div class="col-md-9 bg--light mt-3 pb-3">
                    <h2 class="page-title">Your Order</h2>
                    <section class="top mb-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <h3>Shipping Address</h3> <span id=""></span> <br> <br> &nbsp;
                                    <br>
                                </div>
                                <div class="col-4">
                                    <h3>Payment Method</h3>
                                </div>
                                <div class="col-4">
                                    <h3>Cart Total</h3> <span><span id="subtotal" class="bold">Subtotal:</span> ₦32500</span> <br> <span><span id="subtotal" class="bold">Shipping:</span> ₦</span> <br> <span><span id="subtotal" class="bold">Coupon:</span> ---</span> <br> <span><span id="total" class="bold">Total:</span> ₦32,500 </span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="card card-plain mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="text-left">Order Date: 09/23/2022</th>
                                            <th colspan="1" scope="col" class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><span class="bold">Status:</span> Processing</th>
                                            <td colspan="3">
                                                <div class="media">
                                                    <div class="img-container"><img src="https://hautesignatures.com/images/products/tn/cjjy4ZnPYY5xPrEy0faHbBoTSDqc29oCs0lAt8Me.png " alt="" class="align-self-start mr-3"></div>
                                                    <div class="media-body ml-3 ">
                                                        <h5 class="mt-0">Fan Belt</h5>
                                                        <div class="font-weight-bolder">



                                                            <br>
                                                            <p class="font-weight-bolder"><span class="bold">Quantity: </span> 1
                                                            </p>
                                                            <p class="font-weight-bolder"><span class="bold">Price: &nbsp;</span> ₦15000.00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Contact Form & Info-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/orders/show.blade.php ENDPATH**/ ?>