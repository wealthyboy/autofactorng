@extends('admin.layouts.app')
@section('content')
<div class="row">
   @include('admin.errors.errors')

   <div class="col-md-7 mt-3">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">filter_alt</i>
            </div>
            <h6 class="mb-0">Edit</h6>
         </div>
         <div class="card-body pt-0">
            <form action="/admin/forum-category/{{$category->id}}" method="post" enctype="multipart/form-data" id="form-category">
               @csrf
               @method('PATCH')
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input type="text" value="{{$category->name}}" class="form-control" name="name">
                     </div>
                  </div>
               </div>

               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-md-5">

   </div>
</div>
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop

@section('inline-scripts')
@include('admin._partials.image_js',['folder' => 'category'])
@stop