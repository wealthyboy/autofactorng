<?php echo $__env->make('_partials.header_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="loaded">
	<div id="app" class="page-wrapper">


		<header class="header">
			<div class="header-middle">
				<div class="container">
					<div class="header-center order-first order-lg-0 ml-0">
						<a href="/" class="logo">
							<img src="<?php echo e($system_settings->logo_path()); ?>" alt="<?php echo e(Config('app.name')); ?> Logo">
						</a>
					</div><!-- End .header-center -->
				</div><!-- End .container -->
			</div><!-- End .header-middle -->


		</header><!-- End .header -->
		<main class="main">
			<?php echo $__env->yieldContent('content'); ?>
		</main>
		<footer>
			<div class="footer-bottom">
				<div class="container d-flex justify-content-center align-items-center flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0">© <?php echo e(Config('app.name')); ?>. 2020. All Rights Reserved</p>
				</div><!-- End .container -->
			</div><!-- End .footer-bottom -->
		</footer>
	</div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->






	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="/js/checkout.js?version=<?php echo e(str_random(6)); ?>" type="text/javascript"></script>
	<!-- Main JS File -->
	<?php echo $__env->yieldContent('page-scripts'); ?>
	<script type="text/javascript">
		<?php echo $__env->yieldContent('inline-scripts'); ?>
	</script>
</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/layouts/checkout.blade.php ENDPATH**/ ?>