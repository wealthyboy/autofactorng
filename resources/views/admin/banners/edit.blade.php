@extends('admin.layouts.app')

@section('content')

<div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                
                <div class="card-content">
                    <h4 class="card-title">Banners</h4>
                    <form enctype="multipart/form-data" method="post" action="{{ route('banners.update',['banner' => $banner->id]) }}" class="form-horizontal">
                     @csrf
                     @method('PATCH')
                     <div class="form-group">
                        <label for="title" class="col-sm-2 control-label"> Title</label>
                        <div class="col-sm-10">
                              <input type="text"  name="title" value="{{ $banner ? $banner->title : old('title')   }}" class="form-control" id="title" placeholder="title">
                           
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="sort-order"  class="col-sm-2 control-label">Sort Order</label>
                        <div class="col-sm-10">
                           <input id="sort-order" required="required" type="number" name="sort_order" value="{{  $banner  ? $banner->sort_order : old('sort_order')   }}" class="form-control" id="sort-order" placeholder="sort order">
                        </div>
                     </div>

                     <div class="form-group">
                        <label for="img_alt"  class="col-sm-2 control-label">Image Alt tag</label>
                        <div class="col-sm-10">
                           <input id="" required="required" type="text" name="img_alt" value="{{ !empty(  $banner->img_alt )  ? $banner->img_alt : old('img_alt')   }}" class="form-control" id="img_alt" placeholder="Img Alt">
                        </div>
                     </div>


                     <div class="form-group">
                        <label for="link" class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-10">
                           <input id="link" required="required" type="text" name="link" value="{{  $banner ? $banner->link : old('link')   }}" class="form-control" id="link" placeholder="link">
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Col Width</label>
                        <div class="col-sm-10">
                           <select name="col_width" required="required" class="form-control select2" style="width: 100%;">
                              <option value="" >--choose one--</option>
                                 @foreach ( $cols  as $col ) 
                                    @if( $col  == $banner->col)
                                        <option value="{{ $col }}" selected>{{ $col }}</option>
                                    @else
                                        <option value="{{ $col }}">{{ $col }}</option>
                                    @endif
                                 @endforeach 
                           </select>
                        </div>
                    </div>



                           <div class="form-group">
                                 <label for="title" class="col-sm-2 control-label">Device</label>
                                 <div class="col-sm-10">
                                    <select name="device"  class="form-control select2" style="width: 100%;">
                                       <option value="">--device--</option>
                                       <option  {{ $banner->device == "d-block d-sm-none" ? 'selected' : "" }} value="d-block d-sm-none">Show only on sm devices </option>
                                       <option  {{ $banner->device == "d-none d-lg-block d-xl-block" ? 'selected' : "" }} value="d-none d-lg-block d-xl-block">Show only on lg devices </option>
                                    </select>
                                 </div>
                           </div>


                         <div class="row">
                            <div class="">
                                <div id="m_image"  class="uploadloaded_image text-center mb-3">
                                    <div class="upload-text {{ optional($banner)->image !== null  ?  'hide' : '' }}"> 
                                         
                                            <a class="activate-file" href="#">
                                            <img src="{{ asset('backend/img/upload_icon.png') }}">
                                            <b>Add Image </b> 
                                            </a>
                                    </div>
                                    <div id="remove_image" class="remove_image {{ optional($banner)->image !== null  ?  '' : 'hide' }}">
                                        <a class="delete_image" data-id="{{ $banner->id }}" href="#">Remove</a> | <a  class="activate-file"  href="#">Change</a> 
                                    </div>

                                    <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                                    <input type="hidden"  class="file_upload_input stored_image"  value="{{ $banner->image }}" id="stored_image" name="image">
                                    @if ( $banner->image )
                                       <img id="stored_image" class="img-thumnail" src="{{ $banner->image }}" alt="">
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                  
               
                     <!-- /.box-body -->
                     <div class="box-footer">
                        <button type="submit" class="btn btn-info btn-round pull-right">Submit</button>
                     </div>
                     <!-- /.box-footer -->
                  </form>
                  
                </div>
            </div>
        </div>
       
    </div>

@endsection

@section('inline-scripts')
$(document).ready(function() {
    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");
    Img.initUploadImage({
        url:'/admin/upload/image?folder=banners',
        activator: activateFileExplorer,
        inputFile: main_file,
    });
    Img.deleteImage({
        url:'/admin/delete/image?folder=banners&model=Banner',
        activator: delete_image,
        inputFile: main_file,
    });
});
@stop





