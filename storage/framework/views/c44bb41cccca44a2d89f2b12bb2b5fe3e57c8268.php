<?php $__env->startSection('content'); ?>

<section class="breadcrumb no-banner  justify-content-center">
    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  text-center border-bottom">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link mt-3">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">VIDEO TIPS<li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">VIDEO TIPS</h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home">
    <div class="container-fluid">
        <div class="row justifiy-content-center">
            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div  id="content" class="col-md-6  mb-9 p-">
              <h2 class="mb-1"><?php echo e($video->title); ?></h2>
             <div style="height: 45px; " class="mt-5  d-none d-lg-block  d-xl-block"> <?php echo  html_entity_decode( $video->description)  ?> </div> 
             <div style="height:" class="mt-5  d-md-none d-lg-none d-sm-block"> <?php echo  html_entity_decode( $video->description)  ?> </div> 
             <div style="height: 65px;  " class="mt-5 d-md-block d-lg-none d-sm-none d-xl-none d-xs-none"> <?php echo  html_entity_decode( $video->description)  ?> </div> 

              <?php echo  html_entity_decode($video->link)  ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="margin-top-35">
               <?php echo e($videos->links()); ?>

            </div>
        </div> <!-- /row -->
    </div> <!-- /container -->
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/howto/index.blade.php ENDPATH**/ ?>