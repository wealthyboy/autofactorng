@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card mt-4" id="password">
         <div class="card-header">
            <h5>Add Banner</h5>
         </div>
         <div class="card-body pt-0">
            <form id="" action="{{ route('banners.store') }}" method="post">
               @csrf
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-6 col-4">
                     <div class="input-group input-group-outline ">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Image Alt tag</label>
                        <input type="text" class="form-control" name="img_alt">
                     </div>
                  </div>

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Class</label>
                        <input type="text" class="form-control" name="class">
                     </div>
                  </div>
               </div>

               <div class="input-group input-group-outline mt-3">
                  <label class="form-label">Link</label>
                  <input type="text" class="form-control" name="link">
                  <input type="hidden" class="images" name="image">

               </div>

               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="col_width" id="">
                     <option value="">--Choose Cols--</option>
                     @foreach ( $cols as $col )
                     <option value="{{ $col }}">{{ $col }}</option>
                     @endforeach

                  </select>
               </div>

               <div class="input-group input-group-outline mt-3">
                  <select name="device" class="form-control select2" style="width: 100%;">
                     <option value="" selected="selected">--device--</option>
                     <option value="d-block d-sm-none  ">Show only on sm devices </option>
                     <option value="d-none d-lg-block d-xl-block">Show only on lg devices </option>
                  </select>
               </div>


               <div class="input-group input-group-outline mt-3">
                  <label class="form-label mt-4 ms-0"> </label>
                  <select class="form-control" name="type" id="">
                     <option value="" selected="selected">--Choose Type--</option>
                     <option value="slider">Slider</option>
                     <option value="banner">Banner</option>

                  </select>
               </div>
               @include('admin._partials.single_image')

               <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-4 mb-0">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop

@section('inline-scripts')
@include('admin._partials.image_js',['folder' => 'banners'])
@stop