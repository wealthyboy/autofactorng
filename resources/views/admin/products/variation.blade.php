@if ($product_attributes->count())
<div style="margin-bottom: 10px;" class="row p-attr variation-panel">
    <div class="col-md-9 col-xs-9 col-sm-9">
        <div class="row">
            <input name="has_more_variation"     value="1"   class="" type="hidden">
            <input name="new_variation"     value="1"   class="" type="hidden">
            @foreach($product_attributes as $product_attribute)
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <div class="form-group label-floating">
                    <label class="control-label">{{ $product_attribute->name }}</label>
                    <select  required="true"  name="product_attributes[{{ $counter }}][{{ $product_attribute->id }}]" class="form-control  variation_product_attribute">
                        <option value=""  selected="selected">Choose One</option>
                        @foreach($product_attribute->children as $product_attribute)
                            <option  value="{{ $product_attribute->id }}">&nbsp;&nbsp;&nbsp;{{ $product_attribute->name }} </option>
                        @endforeach
                    </select>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3 col-xs-12 text-right col-sm-12">
        <a href="#" title="remove panel" class="remove-panel"><i class="fa fa-trash-o"></i> Remove</a>  |
        <a href="#" title="open/close panel" class="open-close-panel"><i class="fa fa-plus"></i> Expand</a> 
    </div>

    <div id="variation-panel" data-id="{{ $counter }}"   class="hide v-panel">
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Name</label>
                <input name="variation_name[{{ $counter }}]"  type="text" value="{{ old('name') }}" class="form-control">
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Quantity</label>
                <input name="variation_quantity[{{ $counter }}]"  required="true"  type="number"  value="{{ old('sale_price') }}"  class="form-control variation variation_quantity" type="text">
                <span class="material-input"></span>
            </div>
        </div> 
        <div class="col-md-2">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Price</label>
                <input name="variation_price[{{ $counter }}]"  required="true" value="{{ old('price') }}" class="form-control  variation" type="text">
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Sale Price</label>
                <input name="variation_sale_price[{{ $counter }}]"   value=""  class="form-control variation_sale_price variation" type="text">
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating">
                <label class="control-label">Start Date</label>
                <input class="form-control  pull-right" name="variation_sale_price_starts[{{ $counter }}]" id="datepicker" type="date">
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">
                <label class="control-label">End Date</label>
                <input class="form-control  pull-right" name="variation_sale_price_expires[{{ $counter }}]" id="datepicker" type="date">
                <span class="material-input"></span>
            </div>
        </div>
         
        <div class="clearfix"></div>
        <div class="col-md-3">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Weight</label>
                <input name="variation_weight[{{ $counter }}]"  type="text" value="{{ old('weight') }}" class="form-control">
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Length</label>
                <input name="variation_length[{{ $counter }}]" type="text" value="{{ old('length') }}" class="form-control" >
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Width</label>
                <input name="variation_width[{{ $counter }}]"  value="{{ old('width') }}"  class="form-control" type="text">
                <span class="material-input"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating is-empty">
                <label class="control-label">Height</label>
                <input name="variation_height[{{ $counter }}]"   value="{{ old('height') }}"    value="{{ old('height') }}"  class="form-control" type="text">
                <span class="material-input"></span>
            </div>
        </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="row">
                <div  class="  text-center"></div>
                <div   class="col-md-12 col-sm-6 col-xs-6">
                    <div id="j-drop" class=" j-drop">
                    <input accept="image/*"  required="true" onchange="getFile(this,'variation_image[{{ $counter }}]')" class="upload_input"   data-msg="Upload  your image" type="file"  name="img"  />
                    <div   class=" upload-text  {{ $counter }}"> 
                        <a   class="" href="#">
                            <img class="" src="/backend/img/upload_icon.png">
                            <b>Click to upload image</b> 
                        </a>
                    </div>
                    <div id="j-details"  class="j-details"></div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div id="j-drop"  class="j-drop">
            <input accept="image/*"   onchange="getFile(this,'variation_images[{{ $counter }}][]')" class="upload_input"  multiple="true"   type="file" id="upload_file_input" name="product_image"  />
                <div   class=" upload-text  {{ $counter }}"> 
                <a  class="" href="#">
                    <img class="" src="/backend/img/upload_icon.png">
                    <b>Click on anywhere to upload image</b> 
                </a>
                </div>
                <div id="j-details"  class="j-details">
                    
                </div>
                
            </div>
        </div>
    </div> 
    
    </div> 
    
</div>

@else
@endif








    









    
