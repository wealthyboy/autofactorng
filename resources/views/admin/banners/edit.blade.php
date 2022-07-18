@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card mt-4" id="password">
         <div class="card-header">
            <h5>Add Banner</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="{{ route('banners.update',['banner' => $banner->id]) }}" method="post">
               @csrf
               @method('PATCH')
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Title</label>
                        <input name="title" value="{{ $banner ? $banner->title : old('title')   }}"  type="text" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-6 col-4">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Sort Order</label>
                        <input type="number" value="{{ $banner->sort_order }}"    name="sort_order" class="form-control" placeholder="">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Image Alt tag</label>
                        <input type="text" value="{{ $banner->img_alt }}" class="form-control" name="img_alt">
                     </div>
                  </div>

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Class</label>
                        <input type="text" value="{{ $banner->class }}" class="form-control" name="class">
                     </div>
                  </div>
               </div>

               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Link</label>
                  <input type="text" value="{{ $banner->link }}" class="form-control" name="link">
                  <input type="hidden" class="images" value="{{ $banner->image }}" name="image">

               </div>

               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="col_width" id="">
                     <option  value="">--Choose Cols--</option>
                     @foreach ( $cols  as $col ) 
                        @if( $col  == $banner->col)
                              <option value="{{ $col }}" selected>{{ $col }}</option>
                        @else
                              <option value="{{ $col }}">{{ $col }}</option>
                        @endif
                     @endforeach  
                    
                  </select>
               </div>
               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="type" id="">
                     <option value="" selected="selected">--Choose Type--</option>
                     <option {{ $banner->type == 'slider' ? 'selected' : ''  }} value="slider">Slider</option>
                     <option  {{ $banner->type == 'banner' ? 'selected' : ''  }}  value="banner">Banner</option>
   
                  </select>
               </div>
               <div class="row mt-3">
                  <div class="col-12">
                        <label class="form-control mb-0"></label>
                        <div action="/file-upload" class="form-control border dropzone" id="dropzone"></div>
                  </div>
               </div>
               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('inline-scripts')
Dropzone.autoDiscover = false;
var drop = document.getElementById('dropzone')
let imgs = []

var myDropzone = new Dropzone(drop, {
   url: "/admin/upload/image?folder=banners",
   addRemoveLinks: true,
   acceptedFiles: ".jpeg,.jpg,.png,.JPG,.PNG",
   paramName: 'file',
   maxFiles: 1,
   sending: function(file, xhr, formData) {
     formData.append("_token", "{{ csrf_token() }}");
   },
  success(file, res, formData) {
         imgs.push(res.path)
         console.log(imgs)
     $('.images').val(imgs)
  },
   headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
   }
});
@stop











