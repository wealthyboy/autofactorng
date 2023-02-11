$(document).ready(function() {
   let activateFileExplorer = 'a.activate-file';
   let delete_image = 'a.delete_image';
   var main_file = $("input#file_upload_input");

   Img.initUploadImage({
      url:'/admin/upload/image?folder=<?php echo e($folder); ?>',
      activator: activateFileExplorer,
      inputFile: main_file,
   });

   Img.deleteImage({
      url:'/admin/delete/image?folder=<?php echo e($folder); ?>',
      activator: delete_image,
      inputFile: main_file,
   });

});<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/autofactorng/resources/views/admin/_partials/image_js.blade.php ENDPATH**/ ?>