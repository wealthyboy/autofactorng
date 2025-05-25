@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.forums.store') }}" class="" method="post" enctype="multipart/form-data" id="car_reviews">
   @csrf
   <div class="row">
      <div class="col-md-7">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               </div>
               <h6 class="mb-0">Add</h6>
            </div>
            <div class="card-body pt-0">
               @include('errors.errors')
               @csrf
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Title</label>
                        <input type="text" class="form-control" name="title" required id="title">
                     </div>
                  </div>

                  <div class="col-sm-12 col-12 mt-3">
                     <select name="forum_category_id" class="form-select  mb-3 border p-2 ps-2" aria-label=".form-select-lg example">
                        <option selected value=""> Select Category</option>
                        @foreach($categories as $category)
                        <option class="" value="{{ $category->id }}">{{ $category->name }} </option>
                        @endforeach
                     </select>
                  </div>



               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <label class="form-label">Description</label>
                     <div class="input-group input-group-outline">
                        <textarea id="forum-description" type="text" class="form-control" name="content" rows="8" required>{{ old('description') }}</textarea>
                     </div>
                  </div>
               </div>

               <div class="col-12 my-3">
                  @include('admin._partials.single_image')
               </div>


               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">
                     <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                     <span id="submit-product-form-text">Submit</span>
                  </button>

               </div>
            </div>
         </div>
      </div>
      <div class="col-md-5">

      </div>
   </div>
</form>



@endsection
@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="{{ asset('backend/products.js') }}"></script>
@stop
@section('inline-scripts')
@include('admin._partials.image_js',['folder' => 'forum'])
@stop