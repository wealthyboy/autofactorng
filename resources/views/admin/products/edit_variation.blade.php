<div class="variable-products   {{ $product->product_type == 'simple' ? 'hide' : '' }}">
    @if ($product->variants->count())
        @foreach($variants as $variant)
        <div style="" class="row p-attr variation-panel">
            <div class="col-md-9 col-xs-9 col-sm-9">
            <input name="edit_variation"  value="1"   class="" type="hidden">
                <div class="row">
                    @foreach($product_attributes as $product_attribute)
                        <?php  $variantion_value = $product_attribute
                                    ->variation_value()
                                    ->where('product_variation_id',$variant->id)
                                    ->first() 
                        ?>
                        <div class="col-md-3 col-xs-6 col-sm-6">
                            <div class="form-group label-floating">
                                <label style="
                                        top: -28px;
                                        left: 0;
                                        font-size: 11px;
                                        line-height: 1.0714285718;" 
                                        class="control-label">{{ $product_attribute->name }} {{ optional($variant)->id }} </label>
                                <select  
                                        name="{{ optional($variantion_value)->attribute_id  ? "edit_product_attributes[$variant->id][$variantion_value->id][$product_attribute->id]" : "add_to_product_attributes[$variant->id][$product_attribute->id]" }}" 
                                        class="form-control">
                                        @if (  optional($variantion_value)->name !== null)
                                        <option 
                                            value="">
                                            Choose one
                                        </option>
                                        @endif

                                        <option 
                                            value="{{ optional($variantion_value)->attribute_id  ?? '' }}" selected>
                                            {{ optional($variantion_value)->name  ?? 'Choose one' }}
                                        </option>
                                    @foreach($product_attribute->children as $pA)
                                    @if (in_array($pA->id,$variant->product_variation_values->pluck('attribute_id')->toarray() ))
                                        @continue;
                                    @endif
                                        <option   value="{{ $pA->id }}">&nbsp;&nbsp;&nbsp;{{ $pA->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach   
                </div>
            </div>
            <div class="col-md-3 col-xs-12 text-right col-sm-12">
                <a href="/admin/variation/delete/{{ $variant->id }}"  data-toggle="tooltip" title="remove panel" class="delete-panel"><i class="fa fa-trash-o"></i> Delete</a> |
                <a href="#"  title="open/close panel" class="open-close-panel"><i class="fa fa-plus"></i> Expand</a> 
            </div>

            <div id="variation-panel" class="hide v-panel">
                   <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group label-floating is-empty">
                            <label class="control-label">Name</label>
                            <input name="edit_variation_name[{{ $variant->id }}]"  type="text" value="{{ $variant->name }}" class="form-control">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group label-floating ">
                            <label class="control-label">Quantity  </label>
                            <input name="edit_variation_quantity[{{ $variant->id }}]"  required="true"  type="number"  value="{{ $variant->quantity }}"   class="form-control variation variation_quantity" type="text">
                            <span class="material-input"></span>
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group label-floating">
                            <label class="control-label">Price</label>
                            <input name="edit_variation_price[{{ $variant->id }}]"  required="true" value="{{ $variant->price }}" class="form-control  variation" type="text">
                            <span class="material-input"></span>
                        
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group label-floating ">
                            <label class="control-label">Sale Price</label>
                            <input name="edit_variation_sale_price[{{ $variant->id }}]"   value="{{ $variant->sale_price }}"   class="form-control variation_sale_price variation" type="text">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label class="control-label">Start Date</label>
                            <input class="form-control  pull-right" name="edit_variation_sale_price_starts[{{ $variant->id }}]" id="datepicker"  value="{{ $variant->sale_price_starts ? date('Y') .'-'. optional($variant->sale_price_starts)->format('m-d') : '' }}" type="date">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="control-label">End Date</label>
                            <input class="form-control  pull-right" name="edit_variation_sale_price_expires[{{ $variant->id }}]"  value="{{ $variant->sale_price_expires ? date('Y') .'-'. optional($variant->sale_price_expires)->format('m-d') : '' }}"  type="date">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-3">
                        <div class="form-group label-floating ">
                            <label class="control-label">Weight</label>
                            <input name="edit_variation_weight[{{ $variant->id }}]"  type="text"  value="{{ $variant->weight }}"  class="form-control">
                            <span class="material-input"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group label-floating ">
                            <label class="control-label">Length</label>
                            <input name="edit_variation_length[{{ $variant->id }}]" type="text" value="{{ $variant->length }}" class="form-control" >
                            <span class="material-input"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group label-floating ">
                            <label class="control-label">Width</label>
                            <input name="edit_variation_width[{{ $variant->id }}]"  value="{{ $variant->width }}"  class="form-control" type="text">
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label class="control-label">Height</label>
                            <input name="edit_variation_height[{{ $variant->id }}]"   value="{{ $variant->height }}"   class="form-control" type="text">
                            <span class="material-input"></span>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div   class="row">
                            <div  class="col-md-12  text-center">
                                <h3 class="title text-center"> Upload Images</h3>
                                <p class="description text">Click on anywhere below to upload image </p>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div  class="  text-center"></div>
                                    <div   class="col-md-12 col-sm-6 col-xs-6">
                                        <div id="j-drop" class=" j-drop">
                                        <input accept="image/*"  onchange="getFile(this,'edit_variation_image[{{ $variant->id }}]')" class="upload_input"   data-msg="Upload  your image" type="file"  name="img"  />
                                        <div   class="upload-text hide"> 
                                            <a   class="" href="#">
                                                <img class="" src="/backend/img/upload_icon.png">
                                                <b>Click to upload image</b> 
                                            </a>
                                        </div>
                                        <div id="j-details"  class="j-details">
                                            <div id="{{ $variant->id }}" class="j-complete">
                                                <div class="j-preview">
                                                    <img class="img-thumnail" src="{{ $variant->image }}">
                                                    <div id="remove_image" class="remove_image remove-image">
                                                        <a class="remove-image"  data-randid="{{ $variant->id }}" data-model="ProductVariation"   data-id="{{ $variant->id }}" data-url="{{ $variant->image }}" href="#">Remove</a>
                                                    </div>
                                                    <input type="hidden" class="file_upload_input stored_image_url" value="{{ $variant->image }}" name="edit_variation_image[{{ $variant->id }}]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div   class="col-md-9 col-sm-6 col-xs-6">
                                <div id="j-drop" class="j-activate j-drop">
                                <input accept="image/*"   onchange="getFile(this,'new_variation_images[{{ $variant->id }}][]')" class="upload_input" multiple="true"  data-msg="Upload  your image" type="file" id="upload_file_input" name="e_v_image"  />
                                <div   class=" upload-text {{ $variant->images->count() ||  $variant->image ? 'hide' : ''}}"> 
                                    <a   class="j-activate" href="#">
                                        <img class="" src="/store/img/upload_icon.png">
                                        <b>Click on anywhere to upload image</b> 
                                    </a>
                                </div>
                                <div id="j-details"  class="j-details">
                                    @if($variant->images->count())
                                        @foreach($variant->images as $image)
                                        <div id="{{ $image->id }}" class="j-complete">
                                            <div class="j-preview">
                                                <img class="img-thumnail" src="{{ $image->image }}">
                                                <div id="remove_image" class="remove_image remove-image">
                                                    <a class="remove-image"  data-id="{{ $image->id }}" data-randid="{{ $image->id }}" data-model="Image" data-type="complete"  data-url="{{ $image->image }}" href="#">Remove</a>
                                                    <input type="hidden" class="file_upload_input stored_image_url" value="{{ $variant->image }}" name="edit_variation_images[{{ $variant->id }}][]">
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

                
            </div>
        @endforeach
    @endif
</div>   



    
