<?php $__env->startSection('content'); ?>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md12">
        <p> Regardless of whether you're an individual or a business, minimizing risk, improving your driving experience, and having confidence in the quality of your replacement parts are all vital considerations. </p>
        <p> By signing up for a subscription plan, you will receive shopping credits equal to your subscription fee, plus an additional 10% credit bonus that you can use to purchase items on our website. </p>
        <p> Additionally, you'll gain access to exclusive advantages and discounts that must be used within one year of the purchase date. </p>
        <p> Don't miss out on the subscription plan's advantages; signup today!</p>
      </div>
      <div class="col-md-8 mx-auto text-center">
        <h3>Pick the best plan for you</h3>
        <p></p>
      </div>
    </div>



    <div class="row mt-5">
      <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-lg-4 col-md-4 col-sm-6 mb-lg-0 mb-4   rounded ">
        <div class="card  border-0 rounded  px-5 py-5 h-100  <?php echo e($key == 'NORMAL DUTY' ? ' py-5 text-white bg-main' : 'bg-white '); ?>">
          <div class="card-header  <?php echo e($key == 'NORMAL DUTY' ? 'text-white bg-main' : 'bg-white'); ?>  text-sm-start text-center pt-4 pb-3 px-4">
            <h5 class="mb-1 <?php echo e($key == 'NORMAL DUTY' ? 'text-white' : ''); ?>"><?php echo e($key); ?></h5>
            <p class="mb-3 text-sm <?php echo e($key == 'NORMAL DUTY' ? 'text-white' : ''); ?> mt-2"><?php echo e($plan['title']); ?></p>
            <h3 class="font-weight-bolder mt-3 <?php echo e($key == 'NORMAL DUTY' ? 'text-white' : ''); ?>">
              <?php echo e($plan['price']); ?> <small class="text-sm text-white font-weight-bold ">/year</small>
            </h3>
            <a href="/subscribe?plan=<?php echo e(str_slug($key, '_')); ?>" class="btn btn-sm py-3 <?php echo e($key == 'NORMAL DUTY' ? 'text-dark bg-white' : ' text-white bg-main'); ?>  bg-gradient-white w-100 border-radius-md mt-4 mb-2 fs-5 bold">Subscribe now</a>
          </div>
          <hr class="horizontal dark my-0">
          <div class="card-body <?php echo e($key == 'NORMAL DUTY' ? 'text-left bg-main' : ''); ?>">

            <?php $__currentLoopData = $plan['text']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="d-flex pb-3  ">
              <span class="material-symbols-outlined">
                check
              </span>
              <span class="text-sm ps-3"><?php echo e($text); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


      <div class="mt-5">
        <h3>
          HOW IT WORKS
        </h3>
        <p> <span class="fw-bold">1. Choose a Plan:</span> Select your preferred subscription plan and follow the prompts to make your payment.</p>
        <p> <span class="fw-bold">2. Get Funded:</span> Once your payment is confirmed, the equivalent amount of Autofactor purchase credit will be funded to your account. You can then use this credit to make purchases on our website.</p>
        <p> <span class="fw-bold">3. Enjoy Your Benefits:</span> All subscription plans are valid for one year from the time of purchase, and any credits or benefits given must be used within this period. During checkout, your available credit will be applied automatically to your purchase.</p>
        <p> <span class="fw-bold">4. Use It or Lose It:</span> It's important to note that any unused credits or benefits after the expiry of the validity period cannot be rolled over or transferred. So, make sure to take advantage of all your benefits before the end of the validity period.</p>
      </div>


    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/plans/index.blade.php ENDPATH**/ ?>