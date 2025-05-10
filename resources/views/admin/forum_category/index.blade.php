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
            <h6 class="mb-0">Add Forum Category</h6>
         </div>
         <div class="card-body pt-0">
            <form action="{{ route('admin.forum-category.store') }}" method="post" enctype="multipart/form-data" id="form-category">
               @csrf
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input type="text" class="form-control" name="name">
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
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">list</i>
            </div>
            <h6 class="mb-0">{{''}}</h6>
         </div>

         <div class="d-flex justify-content-between p-2">
            <div class="parent" value="">
               <div class="form-check ml-0">
                  <label class="custom-control-label" for="delete">
                     <input class="form-check-input" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" id="delete" name="optionsCheckboxes">
                     <span role="button" class="mt-4">Select All</span>
                  </label>
               </div>
            </div>

            <div class="mr-3">
               <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-forum_category').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                  <i class="material-icons"></i> Delete
               </a>
            </div>
         </div>
         <div class="clearfix"></div>
         <form action="/admin/forum-category/1" method="post" enctype="multipart/form-data" id="form-forum_category">
            @csrf
            @method('DELETE')
            <div class="material-datatables">
               <div class="well well-sm pb-5" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
                  @foreach($categories as $category)
                  <div class="parent" value="{{ $category->id }}">
                     <div class="form-check">
                        <label class="custom-control-label" for="attr-{{ $category->id }}">
                           <input class="form-check-input " value="{{ $category->id }}" type="checkbox" id="attr-{{ $category->id }}" name="selected[]">
                           <span role="button">{{ $category->name == "" ? $category->title :  $category->name}}</span>
                           <a href="/admin/forum-category/{{$category->id}}/edit">
                              <i class="fa fa-pencil"></i> Edit</a>
                        </label>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </form>
      </div><!--  end card  -->
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