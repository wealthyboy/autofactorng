@extends('admin.layouts.app')
@section('content')
<form action="{{ route('products.update',['product'=>$product->id])  }}" class="" method="post" enctype="multipart/form-data" id="form-category">
   @method('PATCH') 
   @csrf

   <div class="row">
      <div class="col-md-7">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                  <i class="material-symbols-outlined">filter_alt</i>
               </div>
               <h6 class="mb-0">Edit Product</h6>
            </div>
            <div class="card-body pt-0">
               
               <div class="row">
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label"> Product Name</label>
                        <input 
                           type="text" 
                           class="form-control"                                     
                           name="product_name"
                           value="{{ isset($product) ? $product->product_name : old('product_name') }}"
                           >
                     </div>
                  </div>
                  <div class="col-sm-6 col-12">
                     <div class="input-group input-group-outline">
                     <label class="form-label mt-4 ms-0"> </label>
                        <select class="form-control" name="brand_id" id="">
                            <option  value="">--Brand--</option>
                             @foreach($brands as $brand) 
                                 @if( $product->brand_id == $brand->id)
                                    <option value="{{ $brand->id }}" selected> {{ $brand->name }} </option>
                                    @else
                                    <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                                 @endif
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
                           value="{{ isset($product) ? $product->price : old('price') }}"


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
                           value="{{ isset($product) ? $product->sale_price : old('sale_price') }}"
                        >
                     </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                  <div class="input-group input-group-outline">
                    <label class="form-label">Sales Start  Date</label>
                      <input name="sale_price_starts" value="{{ $product->sale_price_starts  }}" class="form-control datetimepicker" type="text" data-input>
                    </div>
                  </div>
                  <div class="col-sm-6 col-12 mt-3">
                    <div class="input-group input-group-outline">
                      <label class="form-label">Sales End  Date</label>
                      <input name="sale_price_ends"  value="{{ $product->sale_price_ends  }}" class="form-control datetimepicker" type="text" data-input>
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
                           value="{{ isset($product) ? $product->radius : old('product_radius') }}"

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
                           value="{{ isset($product) ? $product->width : old('width') }}"
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
                           value="{{ isset($product) ? $product->height : old('height') }}"
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
                           value="{{ isset($product) ? $product->title : old('meta_title') }}"
                        >
                     </div>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Keywords</label>
                        <input 
                           type="text" 
                           class="form-control" 
                           name="keywords"
                           value="{{ isset($product) ? $product->keywords : old('keywords') }}"
                        >

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
                           {{ isset($product) ? $product->meta_description : old('meta_description') }}
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
                           {{ isset($product) ? $product->description : old('description') }}
                        </textarea>
                     </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-sm-12 col-12">
                    <label class="form-label">Physical Description</label>

                     <div class="input-group input-group-outline">
                        <textarea type="text" class="form-control"                                     
                           name="phy_desc"
                           rows="8"
                           id="phy_description"
                           >
                           {{ isset($product) ? $product->phy_desc : old('phy_desc') }}
                        </textarea>
                     </div>
                  </div>
               </div>

              
               <div class="col-12">
                  <label class="form-control mb-0"></label>
                  <div action="/file-upload" class="form-control border dropzone" id="dropzone"></div>
               </div>

               <hr class="horizontal dark">
               

               <div class="form-check form-switch">
               <input class="form-check-input"  name="condition_is_present" value="1" {{  $product->condition_is_present ? 'checked' : ''}} type="checkbox" id="heavy_item">
                  <label class="form-check-label" for="heavy_item">Heavy Item</label>
               </div>

               <div id="large-items" class="row mt-3 {{  $product->condition_is_present ? '' : 'd-none'}}">
                  
                <h6>Lagos</h6>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[lagos][tag]" id="" class="form-control">
                        <option value="quantity">Quantity</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[lagos][condition]" id="" class="form-control">
                        <option value=">">is greater than</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[lagos][tag_value]" id="" class="form-control">
                        @for($i = 1; $i < 6; $i++)
                           @if ($i ==  optional($product->heavy_item_lagos)->tag_value)
                              <option value="{{ $i }}" selected>{{ $i }}</option>
                           @else
                              <option value="{{ $i }}">{{ $i }}</option>
                           @endif
                        @endfor
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                     <div class="input-group input-group-outline">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" value="{{ optional($product->heavy_item_lagos)->price }}" name="condition[lagos][price]">
                     </div>
                </div>

                <h6 class="my-3">Outside Lagos</h6>

                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[out_side_lagos][tag]" id="" class="form-control">
                        <option value="quantity">Quantity</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[out_side_lagos][condition]" id="" class="form-control">
                        <option value=">">is greater than</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-3 col-12">
                  <div class="input-group input-group-outline">
                    <label class="form-label"> </label>
                    <select name="condition[out_side_lagos][tag_value]" id="" class="form-control">
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
                        <input type="text" class="form-control" value="{{ optional($product->heavy_item_outside_lagos)->price }}" name="condition[out_side_lagos][price]">
                     </div>
                </div>
        
            </div>

 
               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-dark m-0 ms-2">Submit</button>
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
                          <label  class="custom-control-label" for="{{ $attribute->id }}">
                             <input  
                                 class="form-check-input" 
                                 value="{{ $attribute->id }}" 
                                 {{ $helper->check($product->attributes, $attribute->id) }} 
                                 type="checkbox" id="{{ $attribute->id }}" 
                                 name="attribute_id[]" 
                              >
                              <span role="button">{{ $attribute->name }}</span> 
                                <a href="{{ route('attributes.edit',['attribute'=>$attribute->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a>
                          </label>
                      </div> 
                      @include('includes.edit_children',[ 'collections' => $product->attributes, 'obj'=>$attribute,'space'=>'&nbsp;&nbsp;','model' => 'attributes','url' => 'attribute','year' => true, 'name' => 'attribute_id'])
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
                  <div class="parent" value="{{ $category->id }}">
                      
                      <div class="form-check ">
                          <input  
                              class="form-check-input" 
                              {{ $helper->check($product->categories, $category->id) }} 
                              value="{{ $category->id }}" 
                              type="checkbox" 
                              name="category_id[]"
                           >
                          <label  class="custom-control-label" for="">
                              <span role="button">{{ $category->name }}</span> 
                                <a href="{{ route('category.edit',['category'=>$category->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a>
                          </label>
                      </div> 
                      @include('includes.edit_children',[ 'collections' => $product->categories, 'obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category','name' => 'category_id'])
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
@stop
@section('inline-scripts')
   CKEDITOR.replace('phy_description',{
         height: '200px',
         toolbar: [
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            '/',
            { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
            { name: 'others', items: [ '-' ] },
         ]
   })

   if (document.getElementById('editor')) {
      var quill = new Quill('#editor', {
         theme: 'snow' // Specify theme in configuration
      });
   }

   if (document.querySelector('.datetimepicker')) {
      flatpickr('.datetimepicker', {
         allowInput: true
      }); // flatpickr
   }

   Dropzone.autoDiscover = false;
   var drop = document.getElementById('dropzone')
   let imgs = []

   let myDropZone = new Dropzone(drop, {
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

   });

   @foreach($product->images as $image)

      myDropZone.emit('addedfile', {
         id: {{  $image->id }},
         name: '{{ $image->image }}',
         size: 12833
      })

      myDropZone.emit("thumbnail", {
         id: {{  $image->id }},
         name: '{{ $image->image }}',
         size: 12833

      },  'http://auto.test/images/products/oLEEqcY6akZrixKXR3HPcFqLAfjDvoHAgN1nZUpB.png');

   @endforeach

   $('#heavy_item').on('click', function() {
      console.log(true)
      var element = document.getElementById("large-items");
      element.classList.toggle("d-none");
   })

@stop