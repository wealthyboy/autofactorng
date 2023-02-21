<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.errors.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="row">
    <div class="col-md-6">
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Add Engine</h5>
            </div>
            <div class="card-body pt-0">
                <form id="" action="<?php echo e(route('engines.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-group input-group-outline">
                        <label class="form-label">Engine Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>



                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('inline-scripts'); ?>
Dropzone.autoDiscover = false;
var drop = document.getElementById('dropzone')
let imgs = []

var myDropzone = new Dropzone(drop, {
url: "/admin/upload/image?folder=brands",
addRemoveLinks: true,
acceptedFiles: ".jpeg,.jpg,.png,.JPG,.PNG",
paramName: 'file',
maxFiles: 10,
sending: function(file, xhr, formData) {
formData.append("_token", "<?php echo e(csrf_token()); ?>");
},
success(file, res, formData) {
imgs.push(res.path)
console.log(imgs)
$('.image').val(imgs)
},
headers: {
'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
}
});;
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/engines/create.blade.php ENDPATH**/ ?>