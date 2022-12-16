<?php $helper = app('App\Http\Helper'); ?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(Config('app.name')); ?> | Admin</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Favicone Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png">
    <link rel="apple-touch-icon" href="/img/favicon-96x96.png">

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!--  Material Dashboard CSS    -->
    <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet" />
    <?php echo $__env->yieldContent('page-styles'); ?>
</head>


<body class="g-sidenav-show bg-gray-200">

    <main class="main-content max-height-vh-100 h-100">

        <div class="container-fluid py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/js/dashboard.js"></script>
    <?php echo $__env->yieldContent('page-scripts'); ?>
    <script type="text/javascript">
        <?php echo $__env->yieldContent('inline-scripts'); ?>
    </script>
</body>


</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/layouts/invoice.blade.php ENDPATH**/ ?>