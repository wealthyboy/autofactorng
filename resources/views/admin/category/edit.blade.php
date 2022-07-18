@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-7">
      <div class="card">
         <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
               <i class="material-symbols-outlined">list</i>
            </div>
            <h6 class="mb-0">Edit </h6>
         </div>
         <div class="card-body pt-0">
            <form  action="{{ route('category.update',['category' => $cat->id ]) }}" method="post">
               @csrf
               @method('PATCH')
               <div class="row">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Name</label>
                        <input 
                           class="form-control"
                           name="name"
                           type="text"
                           value="{{ $cat->name }}"
                           required="true"
                           />
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Sort order</label>
                        <input 
                           class="form-control"
                           name="sort_order"
                           type="text"
                           value="{{ $cat->sort_order }}"
                           />
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Custom  Link</label>
                        <input type="text" 
                           class="form-control"                                     
                           name="custom_link"
                           type="text"
                           value="{{ $cat->link }}"
                           >
                        <input 
                           type="hidden" 
                           class="image"                                     
                           name="image" 
                           value="{{ $cat->image }}"
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
                           type="text" 
                           value="{{ $cat->keywords }}"
                           >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Description</label>
                        <textarea type="text" class="form-control"                                     
                           name="meta_description"
                           rows="8"
                           onfocus="focused(this)" onfocusout="defocused(this)"
                           >{{ $cat->description }}</textarea>
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
                           @if($cat->parent_id ==  $category->id )
                           <option class="" value="{{ $category->id }}" selected="selected">{{ $category->name }} </option>
                           @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                           @else
                           <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                           @include('includes.children_options',['model' => $cat,'obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                           @endif
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
var drop = document.getElementById('dropzone')
var myDropzone = new Dropzone(drop, {
   url: "/admin/upload/image?folder=category",
   addRemoveLinks: true,
   uploadMultiple: false,
   maxFiles: 1,

});
@stop






