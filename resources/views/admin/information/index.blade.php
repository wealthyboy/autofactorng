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
                        <label class="form-label"> Title</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="title"
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
              
               <div class="row">
                  <div class="">
                     <div class="row">
                        <div class="col-sm-12 col-5">
                            <label class="form-label mt-4 ms-0">Parent </label>
                            <select class="form-control" name="parent_id" id="parent_id">
                              <option  value="">--Choose One--</option>
                                @foreach($pages as $page)
                                    @if($page->isParent())
                                        <option class="" value="{{ $page->id }}" >{{ $page->title }} </option>
                                        @foreach($page->children as $page)
                                            <option class="" value="{{ $page->id }}" >&nbsp;&nbsp;&nbsp;{{ $page->title }} </option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-5">
                           <label class="form-label mt-4 ms-0">Same Page </label>
                           <select class="form-control" name="parent_id" id="parent_id">
                              <option  value="">--Choose One--</option>
                           </select>
                        </div>


                        
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
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">list</i>
            </div>
            <h6 class="mb-0">Pages</h6>
         </div>
         <div class="clearfix"></div>
         <form action="{{ route('pages.destroy',['page'=>1]) }}" method="post" enctype="multipart/form-data" id="form-categories">
            @csrf
            @method('DELETE')
            <div class="material-datatables">
               <div class="well well-sm pb-5" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
                  @foreach($pages as $page)
                  <div class="parent" value="{{ $page->id }}">
                     <div class="form-check ">
                        <input  class="form-check-input" value="{{ $page->id }}" type="checkbox" name="selected[]" >
                        <label  class="custom-control-label" for="">
                        <span role="button">{{ $page->name }}</span> 
                        <a href="{{ route('pages.edit',['page'=>$page->id]) }}">
                        <i class="fa fa-pencil"></i> Edit</a>
                        <a href="/products/{{ $page->slug }}">
                        <i class="fa fa-pencil"></i> Link</a> 
                        </label>
                     </div>
                     @include('includes.children',['obj'=>$page,'space'=>'&nbsp;&nbsp;','model' => 'page','url' => 'pages'])
                  </div>
                  @endforeach  
               </div>
            </div>
         </form>
      </div>
      <!--  end card  -->
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