@if (optional($obj)->children)
    @foreach($obj->children->sortBy('name') as $obj)
        <div class="children" value="{{ $obj->id }}">
            <div class="d-flex">
                <div class="form-check">
                    <label  class="custom-control-label" for="attr-{{ $obj->id }}">
                        <input  class="form-check-input" value="{{ $obj->id }}" {{ $helper->check($collections, $obj->id) }} type="checkbox" id="attr-{{ $obj->id }}" name="{{$name}}[]" >
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
                        <div class="col-sm-3 ml-3 col-12">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label "> </label>
                                <select class="form-control mx-3 year" name="year_from[{{ $obj->id }}]" id="">
                                    <option  value="">--Year from--</option>
                                    @foreach($obj->attribute_years as $attribute_year)
                                        <option  value="{{ $attribute_year->year }}">{{ $attribute_year->year }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 ml-3 col-12">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label "> </label>
                                <select class="form-control year" name="year_to[{{ $obj->id }}]" id="">
                                    <option  value="">--Year to--</option>
                                    @foreach($obj->attribute_years as $attribute_year)
                                        <option class="" value="{{ $attribute_year->year }}" >{{ $attribute_year->year }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                @endif


            </div>

            @if (null !== $obj->engines)
                @foreach($obj->engines as $engine)
                <div class="children" value="{{ $engine->id }}">
                    <div class="d-flex">
                        <div class="form-check">
                            <label  class="custom-control-label" for="attr-{{ $engine->id }}">
                                <input  
                                    class="form-check-input" 
                                    value="{{ $engine->id }}" 
                                    type="checkbox" 
                                    id="attr-{{ $engine->id }}" 
                                    name="engine_id[]" 
                                    {{ $helper->check($product->engines, $engine->id) }} 
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