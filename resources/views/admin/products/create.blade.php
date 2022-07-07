@extends('admin.layouts.app')
@section('content')
<form action="{{ route('products.store') }}" class="" method="post" enctype="multipart/form-data" id="form-category">
   @csrf
   <div class="row">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">filter_alt</i>
               </div>
               <h6 class="mb-0">Add Product</h6>
            </div>
            <div class="card-body pt-0">
               @csrf
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Name</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="product_name"
                           >
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                     <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="brand_id" id="">
                            <option  value="">--Brand--</option>
                            @foreach($brands as $brand)
                                <option class="" value="{{ $brand->id }}" >{{ $brand->name  }} </option>
                            @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-sm-3 col-5">
                        <select class="form-control" name="category_id" id="parent_id">
                            <option  value="">--Choose One--</option>
                            @foreach($categories as $category)
                                <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                                @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                            @endforeach
                        </select>
                      </div>

                  
               </div>
              
               <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Engine</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="engine"
                           >
                     </div>
                  </div>
                 

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                     <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="year_from" id="">
                            <option  value="">--Year from--</option>
                            @foreach($years as $year)
                                <option class="" value="{{ $year }}" >{{ $year }} </option>
                            @endforeach
                        </select>
                     </div>
                     
                  </div>
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                     <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="year_to" id="">
                            <option  value="">--Year to--</option>
                            @foreach($years as $year)
                                <option class="" value="{{ $year }}" >{{ $year }} </option>
                            @endforeach
                        </select>
                     </div>
                     
                  </div>
                 
               </div>

               <div class="row mt-3">
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Price</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="price"
                           required
                           >
                     </div>
                  </div>

                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sale  Price</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="sale_price"
                           >
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label">Sales Start  Date</label>
                      <input name="sale_price_start" class="form-control datetimepicker" type="text" data-input>
                    </div>
                  </div>
                  <div class="col-sm-3 col-12">
                    <div class="input-group input-group-outline">
                      <label class="form-label">Sales End  Date</label>
                      <input name="sale_price_ends"  class="form-control datetimepicker" type="text" data-input>
                    </div>
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Generic Name</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="generic_name"
                           >
                     </div>
                  </div>

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Rim Size</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="rim_size"
                           >
                     </div>
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Radius</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="product_radius"
                           >
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Width</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="product_width"
                           >
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Height</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="product_height"
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
                        <input type="text" class="form-control" name="keywords">

                        <input type="hidden" class="images" name="images">

                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                  <label class="form-label">Meta Description</label>
                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control"                                     
                           name="meta_description"
                           rows="8"
                           >
                           Shop for Optima AGM Yellow Top Battery DH6 Group Size H6/LN3 800 CCA with confidence at Autofactor.com. Parts are just part of what we do. Get yours online today and pick up in store.
                        </textarea>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                    <label class="form-label">Description</label>

                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control"                                     
                           name="description"
                           rows="8"
                           >
                        </textarea>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                    <label class="form-label">Physical Description</label>

                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control"                                     
                           name="physical_description"
                           rows="8"
                           >
                        </textarea>
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
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <!--  end card  -->
         <div class="card mt-4">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">list</i>
               </div>
               <h6 class="mb-0">Attributes</h6>
            </div>
            <div class="material-datatables">
               <div class="well well-sm pb-5" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                @foreach($attributes as $attribute)
                  <div class="parent" value="{{ $attribute->id }}">
                      
                      <div class="form-check ">
                          <input  class="form-check-input" value="{{ $attribute->id }}" type="checkbox" name="selected[]" >
                          <label  class="custom-control-label" for="">
                              <span role="button">{{ $attribute->name }}</span> 
                                <a href="{{ route('attributes.edit',['attribute'=>$attribute->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a>
                          </label>
                      </div> 
                      @include('includes.children',['obj'=>$attribute,'space'=>'&nbsp;&nbsp;','model' => 'attributes','url' => 'attribute'])
                  </div>
                  @endforeach  
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
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

if (document.querySelector('.datetimepicker')) {
      flatpickr('.datetimepicker', {
        allowInput: true
      }); // flatpickr
    }

Dropzone.autoDiscover = false;
var drop = document.getElementById('dropzone')
let imgs = []

var myDropzone = new Dropzone(drop, {
   url: "/admin/upload/image?folder=products",
   addRemoveLinks: true,
   acceptedFiles: ".jpeg,.jpg,.png,.JPG,.PNG",
   paramName: 'file',
   maxFiles: 10,
   sending: function(file, xhr, formData) {
     formData.append("_token", "{{ csrf_token() }}");
   },
  success(file, res, formData) {
         imgs.push(res.path)
         console.log(imgs)
     $('.images').val(imgs)
  },
   headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
   }
});
@stop