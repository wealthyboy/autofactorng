@extends('admin.layouts.app')
@section('pagespecificstyles')
@stop
@section('content')
<div class="row">
   <div class="col-sm-12">
      @include('admin.errors.errors')
      <!--      Wizard container        -->
      <div class="wizard-container">
         <div class="card wizard-card" data-color="rose" id="wizardProfile">
         <form enctype="multipart/form-data" action="{{ route('products.update',['product'=>$product->id])  }}" method="post">
               @method('PATCH')
               @csrf
               <!--  You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
               <div class="wizard-header">
                  <h3 class="wizard-title">
                     Edit Product
                  </h3>
               </div>
               <div class="wizard-navigation">
                  <ul>
                     <li><a href="wizard.html#ProductData" data-toggle="tab">Product Data</a></li>
                     <li><a href="wizard.html#RelatedProducts" data-toggle="tab">Related Products</a></li>
                     <li><a href="wizard.html#ProductVariations" data-toggle="tab">Product Variation</a></li>
                  </ul>
               </div>

               <div class="tab-content">
                  
                  <div class="tab-pane" id="ProductData">
                     <h4 class="info-text">Enter Products Details</h4>
                     <div class="row">
                        <div class="col-md-8">
                           <div class="row">
                              <div class="col-md-7">
                                 <div class="form-group label-floating ">
                                    <label class="control-label">Product Name</label>
                                    <input  required="true" type="text" value="{{ isset($product) ? $product->product_name : old('product_name') }}" name="product_name" class="form-control" >
                                    <span class="material-input"></span>
                                 </div>
                              </div>

                              <div class="col-md-5">
                                 <div class="form-group label-floating">
                                    <label class="control-label">Brands</label>
                                    <select name="brand_id" class="form-control">
                                       <option  >Choose One</option>
                                        @foreach($brands as $brand) 
                                             @if( $product->brand_id == $brand->id)
                                                <option value="{{ $brand->id }}" selected> {{ $brand->brand_name }} </option>
                                                @else
                                                <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                             @endif
                                        @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">

                           <div class="col-md-12">
                              <div class="form-group label-floating is-empty">
                              <label class="control-label">Meta Tile</label>
                              <input  required="true" name="meta_title" data-msg="" value="{{ isset($product) ? $product->meta_title : old('meta_title') }}" class="form-control" type="text">
                              <span class="material-input"></span>
                              </div>
                           </div>

                           <div class="col-md-12">
                              <div class="form-group label-floating is-empty">
                                 <label class="control-label">Meta Keywords</label>
                                 <input  required="true" name="meta_keywords" data-msg="" value="{{ isset($product) ? $product->meta_keywords : old('meta_keywords') }}" class="form-control" type="text">
                                 <span class="material-input"></span>
                              </div>
                           </div>

                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                       <label class="control-label"> Meta description </label>
                                       <textarea name="meta_description" 
                                       id="" class="form-control" rows="10">{{ isset($product) ? $product->meta_description : old('meta_description') }}</textarea>
                                 </div>
                              </div>
                           </div>
                           
                          <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Description</label>
                                    <div class="form-group ">
                                       <label class="control-label"> Enter description here</label>
                                       <textarea name="description" 
                                       id="description" class="form-control" rows="50">{{ isset($product) ? $product->description : old('description') }}</textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                  <legend>  
                                    Enable/Disable
                                  </legend>
                                  <div class="togglebutton">
                                    <label>
                                    <input {{ $product->allow == 1 ? 'checked' : ''}}  name="allow"  value="1" type="checkbox">
                                    Enable/Disable
                                    </label>
                                 </div>
                              </div>
                              
                               <div class="col-md-6">
                                  <legend>  
                                    Featured Product
                                  </legend>
                                  <div class="togglebutton">
                                    <label>
                                        <input {{ $product->featured == 1 ? 'checked' : '' }} name="featured_product"  value="1" type="checkbox" >
                                      Yes/No
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        <div class="col-md-4">
                           <label>Catgeories</label>
                           <div class="well well-sm" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                              @foreach($categories as $category)
                                 <div class="parent" value="{{ $category->id }}">
                                       <div class="checkbox">
                                          <label>
                                             <input type="checkbox" 
                                             {{ $category->check($product->categories , $category->id) ? 'checked' : '' }} 
                                             value="{{ $category->id }}" name="category_id[]" >
                                             {{ $category->name }}  
                                          </label>
                                       </div>   
                                       @include('includes.product_categories_children',['obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category'])
                                 </div>
                              @endforeach
                             
                           </div>
                           <h4>Meta Fields  </h4>
                           
                           @foreach($meta_attributes as $meta_attribute)
                              <div class="form-group ">
                                 <label class="control-label ">{{ $meta_attribute->name }}</label>
                                 <select name="meta_fields[{{ $meta_attribute->id }}]" class="form-control"  title="Choose {{ $meta_attribute->name }}" data-style="select-with-transition" title="{{ $meta_attribute->name }}" data-size="7">
                                 <option value="" selected="selected"> Choose One</option>
                                    @foreach($meta_attribute->children as $meta_attribute) 
                                       @foreach($product->meta_fields as $meta_field) 
                                          @if($meta_field->name ==  $meta_attribute->name )
                                             <?php  $metas[] = $meta_attribute->id  ?>
                                             <option   value="{{ $meta_attribute->id }}" selected>{{ $meta_attribute->name }} </option>
                                          @endif
                                       @endforeach
                                       @if (in_array($meta_attribute->id,$metas))
                                         @continue;
                                       @endif 
                                       <option   value="{{ $meta_attribute->id }}">{{ $meta_attribute->name }} </option>
                                    @endforeach
                                 </select>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="RelatedProducts">
                     <h4 class="info-text">Related Products</h4>
                        <div class="row p-attr">
                              <div class="col-md-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Search</label>
                                    <input name="search_products"   type="text" value="" class="search_products form-control" >
                                       <div class="search_product">
                                             <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <tbody id="related_products"></tbody>
                                             </table>
                                       </div>
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              
                              <div class="col-sm-12">
                                 <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                       <tr>
                                          <td>
                                             <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                                                </label>
                                             </div>
                                          </td>
                                          <td class="text-left"> Product Name</td>
                                          <td class="text-left"> Sort Order</td>
                                          <td class="text-left"> Action</td>
                                       </tr>
                                    </thead>
                                       <tbody class="related_products">
                                          @foreach($product->related_products as $related_product) 
                                             <tr class="">
                                                <td class="">
                                                      <div class="checkbox">
                                                         <label>
                                                            <input type="checkbox" name="selected[]" value="" />
                                                         </label>
                                                      </div>
                                                </td>
                                                <td class="text-left p">
                                                   <a class="#" href="#"> {{ optional($related_product->product_variation)->name }}</a>
                                                   <input type="hidden" name="related_products[{{ $related_product->id }}]" value="{{ $related_product->related_id }}" id="" />
                                                </td>
                                                <td class="text-left">
                                                   <input type="number" class="d-none" name="sort_order[{{ $related_product->id }}]" value="" id="" />
                                                </td>
                                                <td class="text-left"><a  class="remove_related_product"  href="/admin/delete/{{ $related_product->id }}/related_products"><i class="fa fa-trash"></i> Delete</a></td>
                                             </tr>
                                          @endforeach 
                                       </tbody>  
                                 </table>
                              </div>
                              
                           </div>
                        <hr/>

                  </div>
                  <div class="tab-pane" id="ProductVariations">
                     <h4 class="info-text">Product Variation</h4>
                        <div class="col-md-12">
                           <h4>Product Type </h4>
                           <div class="form-group">
                              <label class="control-label">Product Type</label>
                              <select name="type" id="product-type" class="form-control"  required="true" title="Please select product type"  title="" data-size="7">
                                 <option value="">Choose One</option>
                                 <option {{ $product->product_type == 'simple' ? 'selected' : '' }}    value="simple">Simple</option>
                                 <option  {{ $product->product_type == 'variable' ? 'selected' : '' }} value="variable">Variable</option>
                              </select>
                           </div>
                        </div>
                        <div class="simple-product   {{ $product->product_type == 'variable' ? 'hide' : '' }}">
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="row">
                                    <div  class="  text-center">
                                    </div>
                                    <div   class="col-md-12 col-sm-6 col-xs-6">
                                       <div id="j-drop" class=" j-drop">
                                          <input accept="image/*"   onchange="getFile(this,'image','Product',false)" class="upload_input"   data-msg="Upload  your image" type="file"  name="img"  />
                                          <div   class="{{ optional($product)->images ? 'hide' : '' }} upload-text"> 
                                             <a   class="" href="#">
                                                <img class="" src="/backend/img/upload_icon.png">
                                                <b>Click to upload image</b> 
                                             </a>
                                          </div>
                                          <div id="j-details"  class="j-details">
                                             <div id="{{ $product->id }}" class="j-complete">
                                                   <div class="j-preview">
                                                      <img class="img-thumnail" src="{{ $product->image }}">
                                                      <div id="remove_image" class="remove_image remove-image">
                                                         <a class="remove-image" data-mode="edit" data-randid="{{ $product->id }}"  data-id="{{ $product->id }}" data-url="{{ $product->image }}" href="#">Remove</a> 
                                                      </div>
                                                      <input type="hidden" class="file_upload_input stored_image_url" value="{{ $product->image }}" name="image">
                                                   </div>
                                                </div>
                                          </div>

                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-9">
                                 <div class="row">
                                    
                                    <div   class="col-md-12 col-sm-6 col-xs-6">
                                       <div id="j-drop" class=" j-drop">
                                          <input accept="image/*"   onchange="getFile(this,'images[]','Image')" class="upload_input" data-msg="Upload  your image" type="file"  name="img"  />
                                          <div   class=" upload-text {{ optional($product->default_variation)->images->count() ? 'hide' : '' }}"> 
                                             <a   class="" href="#">
                                                <img class="" src="/backend/img/upload_icon.png">
                                                <b>Click on anywhere to upload image</b> 
                                             </a>
                                          </div>
                                          <div id="j-details"  class="j-details j-activate">
                                                
                                             @if(optional($product->default_variation)->images->count())
                                             @foreach($product->default_variation->images as $image)
                                                <div id="{{ $image->id }}" class="j-complete">
                                                   <div class="j-preview">
                                                      <img class="img-thumnail" src="{{ $image->image }}">
                                                      <div id="remove_image" class="remove_image remove-image">
                                                         <a class="remove-image"  data-randid="{{ $image->id }}" data-model="Image" data-type="complete"  data-id="{{ $image->id }}" data-url="{{ $image->image }}" href="#">Remove</a>
                                                      </div>
                                                   </div>
                                                </div>
                                             @endforeach
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-1">
                                 <div class="form-group is-empty">
                                    <label class="control-label">Quantity</label>
                                    <input name="quantity"  type="number" required="true"  value="{{ optional($product_variant)->quantity }}"  class="form-control">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group  is-empty">
                                    <label class="control-label">Price</label>
                                    <input name="price"  required="true" type="text" value="{{ isset($product) ? $product->price : old('price') }}" class="form-control">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group  is-empty">
                                    <label class="control-label">Sale Price</label>
                                    <input name="sale_price"   value="{{ $product->sale_price }}"  class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input class="form-control  pull-right" name="sale_price_starts" value="{{   $product->sale_price_starts ? date('Y') .'-'.  optional($product->sale_price_starts)->format('m-d') : '' }}" id="datepicker" type="date">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input class="form-control  pull-right" name="sale_price_expires" value="{{   $product->sale_price_expires ? date('Y') .'-'.  optional($product->sale_price_expires)->format('m-d') : '' }}" id="datepicker" type="date">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group  is-empty">
                                    <label class="control-label">Weight</label>
                                    <input name="weight"   type="text" value="{{ isset($product) ? $product->weight : old('weight') }}" class="form-control">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group  is-empty">
                                    <label class="control-label">Length</label>
                                    <input name="length"   type="text" value="{{ isset($product) ? $product->length : old('length') }}" class="form-control" >
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group is-empty">
                                    <label class="control-label">Width</label>
                                    <input name="width"      value="{{ isset($product) ? $product->width : old('width') }}"  class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group is-empty">
                                    <label class="control-label">Height</label>
                                    <input name="height" value="{{ isset($product) ? $product->height : old('height') }}"  class="form-control" type="text">
                                    <span class="material-input"></span>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="col-md-12">
                              <legend>  
                                  Gift Card
                              </legend>
                              <div class="togglebutton">
                              <label>
                              <input {{ optional($product->default_variation)->is_gift_card == 1 ? 'checked' : ''}}   name="is_gift_card"  value="1" type="checkbox" >
                                 Gift Card
                              </label>
                              </div>
                           </div>
                        </div><!--simple-product-->
                        <div class="row p-attr  variable-product {{ $product->product_type == 'simple' ? 'hide' : '' }}">
                           @if($product_attributes->count())
                           <div class="col-sm-9">
                              @foreach($product_attributes as $product_attribute)
                                 <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="form-group label-floating">
                                       <label class="control-label">{{ $product_attribute->name }}</label>
                                       <select name="#" class="form-control product-attributes"  title="Choose {{ $product_attribute->name }}" data-style="select-with-transition"  data-size="7">
                                          <option  value="" selected>Select</option>
                                          <option   value="{{ $product_attribute->id }}">&nbsp;&nbsp;&nbsp;{{ $product_attribute->name }} </option>
                                       </select>
                                    </div>
                                 </div>
                              @endforeach
                           </div>
                           <label class="col-md-3  col-xs-12 col-xs-12">
                              <button type="button"  id="product-attribute-add" class="btn btn-round btn-primary">
                                 Add Variation
                                 <span class="btn-label btn-label-right">
                                    <i class="fa fa-plus"></i>
                                 </span>
                              </button>
                           </label>
                           @else
                              <div class="col-sm-7">
                                 No attributes set. Go Products > attributes and set your attributes.
                              </div>
                           @endif
                        </div>
                        @include('admin.products.edit_variation')
               </div>
               <div class="wizard-footer">
                  <div class="pull-right">
                     <input type='button' class='btn btn-next btn-fill btn-rose btn-round btn-wd' name='next' value='Next' />
                     <input type='submit' class='btn btn-finish btn-fill btn-rose   btn-round  btn-wd' name='finish' value='Finish' />
                  </div>
                  <div class="pull-left">
                     <input type='button' class='btn btn-previous btn-fill btn-primary  btn-round  btn-wd' name='previous' value='Previous' />
                  </div>
                  <div class="clearfix"></div>
               </div>
            </form>
         </div>
      </div>
      <!-- wizard container -->
   </div>
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js?version='.mt_rand(1000000, 9999999)) }}"></script>
<script src="{{ asset('backend/js/products.js?version='.mt_rand(1000000, 9999999)) }}"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
   CKEDITOR.replace('description',{
        height: '400px'
   })
});
@stop

