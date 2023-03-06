        
<?php $__env->startSection('content'); ?>

<section class="breadcrumb no-banner  justify-content-center">
    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  text-center border-bottom">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($information->title); ?></li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title"><?php echo e($information->title); ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home">   
    <div class="container">
        <div class="row justifiy-content-center">        
          <div id="content" class="col-md-12  mb-5">  
              <?php if($message = \Session::get('success')): ?>
                  <p><a href=""> <<< Back </a></p>
                  <div class="alert alert-success color--light alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                      <strong><?php echo e($message); ?></strong>
                  </div>
                <?php elseif($errors->any() ): ?>
                  <p><a href=""> <<< Back </a></p>
                  <div class="alert alert-danger">
                      <ul>
                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><?php echo e($error); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                  </div>
                    
                <?php else: ?>
                 <p><?php echo  html_entity_decode($information->description);  ?></p>
                <?php endif; ?>
          </div>
        <div class="margin-top-35"></div>
      </div> <!-- /row -->
    </div> <!-- /container -->
</section>


 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/pages/index.blade.php ENDPATH**/ ?>