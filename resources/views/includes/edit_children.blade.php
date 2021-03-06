@if (optional($obj)->children)
    @foreach($obj->children->sortBy('name') as $obj)
        <div class="children" value="{{ $obj->id }}">
            <div class="d-flex">
                <div class="form-check">
                    <label  class="custom-control-label" for="{{ $obj->name }}-{{ $obj->id }}">
                        <input  class="form-check-input" value="{{ $obj->id }}" {{ $helper->check($collections, $obj->id) }} type="checkbox" id="{{ $obj->name }}-{{ $obj->id }}" name="{{$name}}[]" >
                        <span role="button">{{ $obj->name }}</span>
                        <a href="{{ route($model.'.edit',[$url => $obj->id]) }}">
                            <i class="fa fa-pencil"></i> 
                            Edit
                        </a>

                        @if(isset($link))
                        |
                        <a  href="{{ config('app.url') }}/products/{{ $obj->slug }}">
                           <i class="fa fa-external-link" aria-hidden="true"></i>Link
                        </a> 
                        @endif


                    </label>
                </div>


                @if (isset($year) && $year)
                    @if(null !== $obj->attribute_years))
                        @foreach($product->product_years->where('attribute_id', $obj->id) as $year)     
                            <div class="col-sm-3 ml-3 col-12">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label "> </label>
                                    <select class="form-control mx-3 year" name="year_from[{{ $obj->id }}]" id="">
                                        <option  value="">--Year from--</option>
                                        @foreach($obj->attribute_years as $attribute_year)
                                            <option   {{ $year->year_from == $attribute_year->year? 'selected' : '' }} value="{{ $attribute_year->year }}">{{ $attribute_year->year }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 ml-3 col-12">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label "> </label>
                                    <select class="form-control mx-3 year" name="year_to[{{ $obj->id }}]" id="">
                                        <option  value="">--Year to--</option>
                                        @foreach($obj->attribute_years as $attribute_year)
                                            <option   {{ $year->year_to == $attribute_year->year? 'selected' : '' }} value="{{ $attribute_year->year }}">{{ $attribute_year->year }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @endforeach 
                    @endif
                @endif
            </div>

            @if (null !== $obj->engines)
                @foreach($obj->engines as $engine)
                    <div class="children">
                        <div class="d-flex">
                            <div class="form-check">
                                <label  class="custom-control-label" for="{{ $obj->name }}-{{ $engine->id }}">
                                    <input  
                                        class="form-check-input" 
                                        value="{{ $engine->id }}" 
                                        type="checkbox" 
                                        id="{{ $obj->name }}-{{ $engine->id }}" 
                                        name="engine_id[{{ $obj->id }}][]" 
                                        {{ $helper->check($product->engines, $obj->id, true, $engine->id) }} 

                                    >
                                    <span role="button">{{ $engine->name }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @include('includes.children',['obj'=>$obj])
        </div>
    @endforeach
@endif