@extends('admin.layouts.app')

@section('content')


@endsection

@section('inline-scripts')

$(document).ready(function() {
    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");

    Img.initUploadImage({
        url:'/admin/upload/image?folder=category',
        activator: activateFileExplorer,
        inputFile: main_file,
    });

    Img.deleteImage({
        url:'/admin/category/delete/image',
        activator: delete_image,
        inputFile: main_file,
    });
});

@stop





