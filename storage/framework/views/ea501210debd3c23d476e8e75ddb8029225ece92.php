<?php $__env->startSection('content'); ?>

<?php echo $__env->make('admin._partials.t', ['models' => $products, 'name' => 'Products'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('inline-scripts'); ?>
$('#show-panel').on('click', function(e) {
e.preventDefault();
console.log(e)
var element = document.getElementById("search-panel");
element.classList.toggle('hide')
})
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/products/index.blade.php ENDPATH**/ ?>