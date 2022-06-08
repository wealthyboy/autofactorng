    <h4 class="info-text">Enter Products Details</h4>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group label-floating is-empty">
                    <label class="control-label">Product Name</label>
                    <input  required="true" name="product_name" data-msg="" value="{{ old('product_name') }}" class="form-control" type="text">
                    <span class="material-input"></span>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group label-floating">
                    <label class="control-label">Brands</label>
                    <select name="brand_id" class="form-control">
                        <option disabled="" selected="selected"></option>
                        @foreach($brands as $brand) 
                        <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
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
                        id="description" class="form-control" rows="50">{{ old('description') }}</textarea>
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
                    <input name="allow"  value="1" type="checkbox" checked>
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
                        <input name="featured_product"  value="1" type="checkbox" >
                        Yes/No
                    </label>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
            <label>Catgeories </label>
            <div class="well well-sm" style="height: 250px; background-color: #fff; color: black; overflow: auto;">
                @foreach($categories as $category)
                    <div class="parent" value="{{ $category->id }}">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="{{ $category->id }}" name="category_id[]" >
                                {{ $category->name }}  
                                <a href="{{ route('category.edit',['category'=>$category->id]) }}">
                                <i class="fa fa-pencil"></i> Edit</a> 
                            </label>
                        </div>   
                        @include('includes.product_categories',['obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category'])
                    </div>
                @endforeach
            </div>
           
           
           
            <h4>Meta Fields</h4>
            @foreach($meta_attributes as $meta_attribute)
                <div class="form-group label-floating">
                    <label class="control-label">{{ $meta_attribute->name }}</label>
                    <select name="meta_fields[{{ $meta_attribute->id }}]" class="form-control"  title="Choose {{ $meta_attribute->name }}" data-style="select-with-transition" title="{{ $meta_attribute->name }}" data-size="7">
                        <option   value="">Choose One</option>
 
                        @foreach($meta_attribute->children as $meta_attribute)
                            <option   value="{{ $meta_attribute->id }}">&nbsp;&nbsp;&nbsp;{{ $meta_attribute->name }} </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>
        
        

        

