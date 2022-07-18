@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">filter_alt</i>
            </div>
            <h6 class="mb-0">Add Category</h6>
         </div>
         <div class="card-body pt-0">
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data" id="form-category">
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
                        <label class="form-label">Keywords</label>
                        <input type="text" class="form-control"                                     
                           name="keywords"
                           >
                        <input type="hidden" class="image"                                     
                           name="image"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Meta Description</label>
                        <textarea type="text" class="form-control"                                     
                           name="meta_description"
                           rows="8"
                           >
                        </textarea>
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="parent_id" id="">
                           <option  value="">--Choose Parent--</option>
                           @foreach($categories as $category)
                           <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                           @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-12">
                  <label class="form-control mb-0"></label>
                  <div action="/file-upload" class="form-control border dropzone" id="dropzone"></div>
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
            <h6 class="mb-0">Categories</h6>
         </div>
         <div class="clearfix"></div>
         <form action="{{ route('category.destroy',['category'=>1]) }}" method="post" enctype="multipart/form-data" id="form-categories">
            @csrf
            @method('DELETE')
            <div class="material-datatables">
               <div class="well well-sm pb-5" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
                  @foreach($categories as $category)
                  <div class="parent" value="{{ $category->id }}">
                     <div class="form-check ">
                        <input  class="form-check-input" value="{{ $category->id }}" type="checkbox" name="selected[]" >
                        <label  class="custom-control-label" for="">
                        <span role="button">{{ $category->name }}</span> 
                        <a href="{{ route('category.edit',['category'=>$category->id]) }}">
                        <i class="fa fa-pencil"></i> Edit</a>
                        <a href="/products/{{ $category->slug }}">
                        <i class="fa fa-pencil"></i> Link</a> 
                        </label>
                     </div>
                     @include('includes.children',['obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category', 'name' => 'category_id'])
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
@section('inline-scripts')
if (document.getElementById('choices-gender')) {

var gender = document.getElementById('choices-gender');
const example = new Choices(gender);
}
if (document.getElementById('choices-language')) {
var language = document.getElementById('choices-language');
const example = new Choices(language);
}
if (document.getElementById('choices-skills')) {
var skills = document.getElementById('choices-skills');
const example = new Choices(skills, {
   delimiter: ',',
   editItems: true,
   maxItemCount: 5,
   removeItemButton: true,
   addItems: true
});
}
var parent_id = document.getElementById('parent_id');
setTimeout(function () {
const example = new Choices(parent_id);
}, 1);

Dropzone.autoDiscover = false;
let drop = document.getElementById('dropzone')


let imgs = []

var myDropzone = new Dropzone(drop, {
url: "/admin/upload/image?folder=category",
addRemoveLinks: true,
acceptedFiles: ".jpeg,.jpg,.png,.JPG,.PNG",
paramName: 'file',
maxFiles: 1,
sending: function (file, xhr, formData) {
   formData.append("_token", "{{ csrf_token() }}");
},
success(file, res, formData) {
   imgs.push(res.path)
   console.log(imgs)
   $('.image').val(imgs)
},

});
@stop