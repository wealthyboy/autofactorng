@extends('admin.layouts.app')
@section('pagespecificstyles')
<!-- include summernote css/js -->
@stop

@section('content')

<div class="row">
        <div class="col-md-10">
            @include('admin.errors.errors')
            <div class="card">
            <form id="" action="{{ route('pages.update',['page' => $information->id]) }}" method="post">
                   @csrf
                   @method('PATCH')
                    <div class="card-content">
                        <h4 class="card-title">Information</h4>
                           <div class="row" >
                              <div class="col-md-6">
                                 <div class="card">
                                       <div class="card-header text-center">
                                          <h4 class="card-title">Images Only</h4>
                                       </div>
                                       <div class="card-content">
                                          <div id="m_image"  class="uploadloaded_image text-center mb-3">
                                                <div class="upload-text {{ $information->image !== null  ?  'hide' : '' }}"> 
                                                   <a class="activate-file" href="#">
                                                      <img src="{{ asset('store/img/upload_icon.png') }}">
                                                      <b>Add Image </b> 
                                                   </a>
                                                </div>
                                                <div id="remove_image" class="remove_image {{ $information->image !== null  ?  '' : 'hide' }}">
                                                   <a class="delete_image" href="#">Remove</a>
                                                </div>
                                                @if ( $information->image )
                                                   <img id="stored_image" class="img-thumnail" src="{{ $information->image }}" alt="">
                                                @endif
                                                <input type="hidden"  class="file_upload_input  stored_image" value="{{ $information->image }}" name="image">
                                                <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                                             </div>    
                                       </div><!-- end content-->
                                    
                                 </div><!--  end card  -->
                              </div> <!-- end col-md-4 -->
                           </div>
                       
                           <div class="row">
                           
                              <div class="col-md-12">
                                 <div class="form-group label-floating is-empty">
                                    <label class="control-label">Title</label>
                                    <input  required="true" name="title" data-msg="" value="{{ $information->title }}" class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group label-floating is-empty">
                                    <label class="control-label">Sort Order</label>
                                    <input name="sort_order" value="{{ $information->sort_order }}" class="form-control" type="number">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group label-floating is-empty">
                                    <label class="control-label">Custom Link</label>
                                    <input   name="custom_link" value="{{ $information->custom_link }}" class="form-control" type="text">
                                    <span class="material-input"></span>
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

                                       @if($information->parent_id == $page->id)
                                          <option class="" value="{{  $page->id }}" selected="selected">{{ $page->title }} </option>
                                          @continue
                                       @endif

                                       @if($page->isParent())
                                          <option class="" value="{{ $page->id }}">{{ $page->title }} </option>
                                       @else
                                          <option class="" value="{{ $page->id }}">&nbsp;&nbsp;&nbsp;{{ $page->title }} </option>
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
                                       id="description" class="form-control" required rows="20">{{ $information->description }}</textarea>
                                    </div>
                                 </div>
                              </div>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>


@endsection

@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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





