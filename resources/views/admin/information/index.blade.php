@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">filter_alt</i>
            </div>
            <h6 class="mb-0">Add Page</h6>
         </div>
         <div class="card-body pt-0">
            <form action="{{ route('pages.store') }}" method="post" enctype="multipart/form-data" id="form-category">
               @csrf
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="name"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Sort order</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="sort_order"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Custom  Link</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="custom_link"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control"                                     
                           name="meta_title"
                           >
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                    <div class="col-sm-12 col-12">
                        <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="parent_id" id="">
                        <option  value="">--Choose Parent--</option>
                           
                           @foreach($pages as $page)
                                <option class="" value="{{ $page->id }}" >{{ $page->name }} </option>
                                @include('includes.children_options',['obj'=>$page,'space'=>'&nbsp;&nbsp;'])
                            @endforeach
                        </select>
                        </div>
                        
                    </div>
                </div>
                


            
                <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                           <label class="form-label mt-4 ms-0"> </label>
                           <select class="form-control" name="type" id="">
                              <option  value="">--Same Page--</option>
                              <option class="" value="yes">Yes </option>
                              <option class="" value="no" >No</option>

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
                           id="description" class="form-control" required rows="20"></textarea>
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
        @include('admin._partials.children', ['name' => 'selected', 'collections' => $pages, 'year' =>false, 'title' => 'pages' , 'single_name' => 'page', 'route' => 'pages'])
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

var parent_id = document.getElementById('parent_id');
  setTimeout(function () {
  const example = new Choices(parent_id);
}, 1);

@stop