@extends('admin.layouts.app')
@section('pagespecificstyles')
<!-- include summernote css/js -->
@stop
@section('content')

<style>
  .categories .categories {
     margin-left: 20px;
  }
  .checkbox, .radio {
    margin-top: 0px;
    margin-bottom: 0px;
  }
</style>

<div class="row">
    <div class="col-md-8">
        @include('errors.errors')
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Add Page</h4>
                <div class="material">
                    <form id="" action="{{ route('pages.store') }}" method="post">
                        @csrf
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h4 class="card-title">Images Only</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="">
                                            <div id="m_image"  class="uploadloaded_image text-center mb-3">
                                            <div class="upload-text"> 
                                                <a class="activate-file" href="#">
                                                    <img src="{{ asset('backend/img/upload_icon.png') }}">
                                                    <b>Add  Image </b> 
                                                </a>
                                                </div>
                                                <div id="remove_image" class="remove_image hide">
                                                    <a class="delete_image" data-url="url" href="#">Remove</a> | <a  class="activate-file"  href="#">Change</a> 
                                                </div>
                                               
                                                <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                                                <input type="hidden"  class="file_upload_input  stored_image" value="" name="image">
                                            </div>
                                        </div>    
                                    </div><!-- end content-->
                                  
                                </div><!--  end card  -->
                            </div> <!-- end col-md-4 -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">X pos</label>
                                    <input  required="true" name="x_pos" data-msg="" class="form-control" type="text">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Y pos</label>
                                    <input  required="true" name="y_pos" data-msg="" class="form-control" type="text">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group label-floating is-empty">
                                    <label class="control-label">Title</label>
                                    <input  required="true" name="title" data-msg="" class="form-control" type="text">
                                    <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating is-empty">
                                    <label class="control-label">Sort Order</label>
                                    <input name="sort_order" class="form-control" type="number">
                                    <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating is-empty">
                                    <label class="control-label">Custom Link</label>
                                    <input   name="custom_link"  class="form-control" type="text">
                                    <span class="material-input"> Please use full url https://ohram.org/</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="control-label"></label>
                                        <select name="same_page" class="form-control">
                                            <option  value="">--Same Page--</option>
                                            <option class="" value="yes" >Yes</option>
                                            <option class="" value="no" >No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="control-label"></label>
                                        <select name="parent_id" class="form-control">
                                        <option  value="">--Choose One--</option>
                                            @foreach($pages as $page)
                                                @if($page->isParent())
                                                    <option class="" value="{{ $page->id }}" >{{ $page->title }} </option>
                                                    @foreach($page->children as $page)
                                                        <option class="" value="{{ $page->id }}" >&nbsp;&nbsp;&nbsp;{{ $page->title }} </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <div class="form-group ">
                                            <label class="control-label"> </label>
                                            <textarea name="description" 
                                            id="description" class="form-control"  rows="20"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer text-right">
                                <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                            </div>
                    </form>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-6 -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Pages</h4>
                     <div class="text-right">
                        <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form--pages').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i> Delete
                        </a>
                    </div>
                    <div class="material-datatables">
                        <form action="{{ route('pages.destroy',['page'=>1]) }}" method="post" enctype="multipart/form-data" id="form--pages">
                            @csrf
                            @method('DELETE')
                            @foreach($pages as $page)
                                <div class="categories">
                                    @if($page->isParent())
                                        <div class="checkbox">
                                            <label>
                                                <input 
                                                type="checkbox" 
                                                value="{{ $page->id }}" 
                                                name="selected[]" >
                                                {{ $page->title }}  
                                                <a  href="{{ route('pages.edit',['page'=>$page->id]) }}" 
                                                    rel="tooltip" title="Edit" 
                                                    class="btn btn-primary btn-simple btn-xs">	
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                            </label>
                                        </div> 
                                        @foreach($page->children as $page)
                                        <div class="checkbox categories">
                                            <label>
                                                <input type="checkbox" 
                                                value="{{ $page->id }}" 
                                                name="selected[]" >
                                                {{ $page->title }}  
                                                <a  href="{{ route('pages.edit',['page'=>$page->id]) }}" 
                                                    rel="tooltip" title="Edit" 
                                                    class="btn btn-primary btn-simple btn-xs">	
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                            </label>
                                        </div> 
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </form> 
                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-6 -->
    </div> <!-- end row -->




@endsection

@section('page-scripts')
<script src="/ckeditor/ckeditor.js"></script>
@stop

@section('inline-scripts')
$(document).ready(function() {
    CKEDITOR.replace('description',{
        height: '400px'
    })    

    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");
    Img.initUploadImage({
        url:'/admin/upload/image?folder=banners',
        activator: activateFileExplorer,
        inputFile: main_file,
    });
    Img.deleteImage({
        url:'/admin/delete/image?folder=banners&model=Information',
        activator: delete_image,
        inputFile: main_file,

    });
});
@stop





