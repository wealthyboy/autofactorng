$(document).ready(function() {
   let activateFileExplorer = 'a.activate-file';
   let delete_image = 'a.delete_image';
   var main_file = $("input#file_upload_input");

   Img.initUploadImage({
      url:'/admin/upload/image?folder={{ $folder }}',
      activator: activateFileExplorer,
      inputFile: main_file,
   });

   Img.deleteImage({
      url:'/admin/delete/image?folder={{ $folder }}',
      activator: delete_image,
      inputFile: main_file,
   });

});