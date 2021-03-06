@extends('admin.layouts.app')
@section('content')
<form action="{{ route('products.store') }}" class="" method="post" data-method="POST" enctype="multipart/form-data" id="form-product">
   @csrf
   <div class="row">
      <div class="col-md-7">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">filter_alt</i>
               </div>
               <h6 class="mb-0">Add Product</h6>
            </div>
            <div class="card-body pt-0">
               @include('errors.errors')
               @csrf
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Name</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="product_name"
                           value="{{ old('product_name') }}"
                           >
                     </div>
                  </div>
                  <div class="col-sm-6 col-12">
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

                  
               </div>

               <div class="row mt-3">
                  <div class="col-sm-6 col-12">
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

                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Sale  Price</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="sale_price"
                           >
                     </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                  <div class="input-group input-group-outline">
                    <label class="form-label">Sales Start  Date</label>
                      <input name="sale_price_starts" class="form-control datetimepicker" type="text" data-input>
                    </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                    <div class="input-group input-group-outline">
                      <label class="form-label">Sales End  Date</label>
                      <input name="sale_price_ends"  class="form-control datetimepicker" type="text" data-input>
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
                           name="radius"
                           >
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Width</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="width"
                           >
                     </div>
                  </div>

                  <div class="col-sm-4 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Height</label>
                        <input 
                           type="number" 
                           class="form-control"                                     
                           name="height"
                           >
                     </div>
                  </div>
              </div>

               
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Meta Title</label>
                        <input type="text" class="form-control"                                     
                           name="title"
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
                           >Shop for Genuine Parts with Confidence. You Have The Cars. We Have Parts.</textarea>
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
                           >{{ isset($product) ? $product->description : old('description') }}</textarea>
                     </div>
                  </div>
               </div>

              

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                    <label class="form-label">Physical Description</label>

                     <div class="input-group input-group-outline">
                        <textarea style="width: 100%;" type="text" class="form-control"                                     
                           name="phy_desc"
                           rows="8"
                           id="phy_description"
                           >
                        </textarea>
                     </div>
                  </div>
               </div>

               

              
               <div class="col-12">
                  @include('admin.products.product_images') 
               </div>

               <hr class="horizontal dark">
               

               <div class="form-check form-switch">
                  <input class="form-check-input"  name="condition_is_present" value="1" type="checkbox" id="heavy_item">
                  <label class="form-check-label" for="heavy_item">Heavy/Large Item</label>
               </div>

               <div id="large-items" class="row mt-3 d-none large-items dup-lagos">
                  
                <h6>Lagos</h6>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[lagos][tag][]" id="" class="form-control">
                        <option value="quantity">Quantity</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[lagos][condition][]" id="" class="form-control">
                        <option value=">">greater than</option>
                        <option value="=">Equal to</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[lagos][tag_value][]" id="" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control"  name="condition[lagos][price][]">
                     </div>
                </div>
               </div>

               

               <div class="row button-lagos large-items my-3 d-none">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addRowLagos();" id="add-more-lagos" type="button" class="btn btn-outline-secondary">+Add more</button>
                  </div>
               </div>


               <div class="row large-items  d-none dup-out-lagos">
                  <h6 class="my-3">Outside Lagos</h6>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][tag][]" id="" class="form-control">
                           <option value="quantity">Quantity</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> </label>
                        <select name="condition[out_side_lagos][condition][]" id="" class="form-control">
                              <option value=">">is greater than</option>
                              <option value="=">Equal to</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                     <label class="form-label"> </label>
                     <select name="condition[out_side_lagos][tag_value][]" id="" class="form-control">
                           <option value="1">1</option>
                           <option value="2">2</option>
                           <option value="3">3</option>
                           <option value="4">4</option>
                           <option value="5">5</option>
                     </select>
                     </div>
                  </div>
                  <div class="col-sm-3 col-12">
                        <div class="input-group input-group-outline">
                           <label class="form-label">Price</label>
                           <input type="text" class="form-control" name="condition[out_side_lagos][price][]">
                        </div>
                  </div>
               </div>


               <div class="row button-lagos large-items my-3 d-none">
                  <div class=" d-flex justify-content-end">
                     <button onclick="addRowOutSideLagos();" id="add-more-out-sidelagos" type="button" class="btn btn-outline-secondary">+Add more</button>
                  </div>
               </div>

 
               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" id="submit-product-form-button" class="btn bg-gradient-dark m-0 ms-2">
                     <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span id="submit-product-form-text">Submit</span>
                  </button>
                 
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-5">
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
                          <label  class="custom-control-label" for="{{ $attribute->name }}-{{ $attribute->id }}">
                             <input data-name="{{ $attribute->name }}" class="form-check-input parent-attr" value="{{ $attribute->id }}" type="checkbox" id="{{ $attribute->name }}-{{ $attribute->id }}" name="attribute_id[]" >
                              <span role="button">{{ $attribute->name }}</span> 
                                <a href="{{ route('attributes.edit',['attribute'=>$attribute->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a>
                          </label>
                      </div> 
                      @include('includes.children',['obj'=>$attribute,'space'=>'&nbsp;&nbsp;','model' => 'attributes','url' => 'attribute','year' => true, 'name' => 'attribute_id','engine' => true, 'route' => 'attributes'])
                  </div>
                  @endforeach  
               </div>
            </div>
         </div>

         <div class="card mt-4">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">list</i>
               </div>
               <h6 class="mb-0">Categories</h6>
            </div>
            <div class="material-datatables">
               <div class="well well-sm pb-5" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                @foreach($categories as $category)
                  <div class="parent">
                     <div class="form-check ">
                        <label  class="custom-control-label" for="{{ $category->name }}-{{ $category->id }}">
                           <input id="{{ $category->name }}-{{ $category->id }}"  class="form-check-input" value="{{ $category->id }}" type="checkbox" name="category_id[]">
                           <span role="button">{{ $category->name }}</span> 
                           <a href="{{ route('category.edit',['category'=>$category->id]) }}">
                           <i class="fa fa-pencil"></i> Edit</a>
                        </label>
                     </div> 
                     @include('includes.children',['obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category','name' => 'category_id','route' => 'category'])
                  </div>
                  @endforeach  
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
@endsection
@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/products.js') }}"></script>
@stop
@section('inline-scripts')
   

   if (document.getElementById('editor')) {
      var quill = new Quill('#editor', {
         theme: 'snow' // Specify theme in configuration
      });
   }

  

   

@stop