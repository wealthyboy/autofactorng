@extends('admin.layouts.app')

@section('content')

<div class="row">
    
        <div class="card mt-4" id="password">
   <div class="card-header">
      <h5>Add Brand</h5>
   </div>
   <div class="card-body pt-0">
   <form id="" action="{{ route('brands.store') }}" method="post">
       @csrf

      <div class="input-group input-group-outline">
         <label class="form-label">Brand Name</label>
         <input type="text" class="form-control"                                     
            name="brand_name"
            onfocus="focused(this)" onfocusout="defocused(this)">
      </div>
      
      <div class="row mt-3">
        <div class="col-12">
          <label class="form-control mb-0">Product images</label>
          <div action="/file-upload" class="form-control border dropzone" id="dropzone"></div>
        </div>
        </div>
      <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Save</button>
      </form>

   </div>
</div>
</div>


@endsection

@section('inline-scripts')
Dropzone.autoDiscover = false;
    var drop = document.getElementById('dropzone')
    var myDropzone = new Dropzone(drop, {
      url: "/file/post",
      addRemoveLinks: true,
      muliple: false
    });
@stop





