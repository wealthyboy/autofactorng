@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">filter_alt</i>
            </div>
            <h6 class="mb-0">Add Blog</h6>
         </div>
         <div class="card-body pt-0">
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data" id="form-category">
               @csrf
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Title</label>
                        <input type="text" class="form-control" name="title">
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Sort order</label>
                        <input type="number" class="form-control" name="sort_order">
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Iframe</label>
                        <input type="text" class="form-control" name="link">
                     </div>
                  </div>
               </div>
              
            
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Description</label>
                        <div class="form-group ">
                           <label class="control-label"> </label>
                           <textarea name="description" id="description" class="form-control" required rows="20"></textarea>
                        </div>
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
   @include('admin._partials.children', ['name' => 'selected', 'collections' => $blogs, 'year' =>false, 'title' => 'Videos' , 'single_name' => 'blog', 'route' => 'blogs'])

   </div>
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop
@section('inline-scripts')
CKEDITOR.replace('description',{
height: '350px'
})



@stop