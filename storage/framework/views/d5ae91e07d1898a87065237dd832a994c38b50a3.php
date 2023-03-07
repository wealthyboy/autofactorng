<?php $__env->startSection('content'); ?>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md12">
        <p>"Whether you're an individual or a business, mitigating risk, enhancing your driving experience, and having confidence in the quality of your replacement parts are crucial. </p>
        <p> By subscribing to a plan, you'll get funded with purchase credits that you can use to shop on our website, with exclusive benefits and discounts that must be used within one year from the time of purchase. </p>
        <p>Don't wait too long to take advantage of the subscription plan benefits!</p>

      </div>
      <div class="col-md-8 mx-auto text-center">
        <h3>Pick the best plan for you</h3>
        <p></p>
      </div>
    </div>

    <div class="row mt-5">
      <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
        <div class="card h-100">
          <div class="card-header text-sm-start text-center pt-4 pb-3 px-4">
            <h5 class="mb-1"><?php echo e($key); ?></h5>
            <p class="mb-3 text-sm"><?php echo e($plan['title']); ?></p>
            <h3 class="font-weight-bolder mt-3">
              <?php echo e($plan['price']); ?> <small class="text-sm text-secondary font-weight-bold">/ year</small>
            </h3>
            <a href="/subscribe?plan=<?php echo e(str_slug($key, '_')); ?>" class="btn btn-sm bg-gradient-dark w-100 border-radius-md mt-4 mb-2">Subscribe now</a>
          </div>
          <hr class="horizontal dark my-0">
          <div class="card-body">

            <?php $__currentLoopData = $plan['text']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="d-flex pb-3">
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

        <p> Choose a Plan: Select your preferred subscription plan and follow the prompts to make your payment.</p>
        <p> Get Funded: Once your payment is confirmed, the equivalent amount of Autofactor purchase credit will be funded to your account. You can then use this credit to make purchases on our website.</p>
        <p> Enjoy Your Benefits: All subscription plans are valid for one year from the time of purchase, and any credits or benefits given must be used within this period. During checkout, your available credit will be applied automatically to your purchase.</p>
        <p> Use It or Lose It: It's important to note that any unused credits or benefits after the expiry of the validity period cannot be rolled over or transferred. So, make sure to take advantage of all your benefits before the end of the validity period.</p>


      </div>


    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/plans/index.blade.php ENDPATH**/ ?>