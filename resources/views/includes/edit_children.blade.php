@if (optional($obj)->children)
    @foreach($obj->children->sortBy('name') as $ob)
        <div class="children" value="{{ $obj->id }}">
            <div class="d-flex">
                <div class="form-check ">
                    <label  class="custom-control-label" for="{{ $ob->slug }}-{{ $ob->id }}">
                        <input  class="form-check-input  car-models {{ $obj->slug }}  {{ $obj->name == 'Spare Parts' || $obj->name == 'Servicing Parts'  ? 'no-validation' : '' }}"  data-name="{{ $ob->slug }}" value="{{ $ob->id }}" {{ $helper->check($collections, $ob->id) }} type="checkbox" id="{{ $ob->name }}-{{ $ob->id }}" name="{{$name}}[]" >
                        <span role="button">{{ $ob->name }}</span>
                        <a href="{{ route($model.'.edit',[$url => $ob->id]) }}">
                            <i class="fa fa-pencil"></i> 
                            Edit
                        </a>

                        @if(isset($link))
                        |
                        <a  href="{{ config('app.url') }}/products/{{ $ob->slug }}">
                           <i class="fa fa-external-link" aria-hidden="true"></i>Link
                        </a> 
                        @endif


                    </label>
                </div>


                @if (isset($year) && $year)
                    @if(null !== $ob->attribute_years))
                        @foreach($product->product_years->where('attribute_id', $ob->id) as $year)     
                            <div class="col-sm-3 ml-3 col-12">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label "> </label>
                                    <select class="form-control mx-3 year {{ $ob->slug }}" name="year_from[{{ $ob->id }}]" id="">
                                        <option  value="">--Year from--</option>
                                        @foreach($ob->attribute_years as $attribute_year)
                                            <option   {{ $year->year_from == $attribute_year->year? 'selected' : '' }} value="{{ $attribute_year->year }}">{{ $attribute_year->year }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 ml-3 col-12">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label "> </label>
                                    <select class="form-control mx-3 year {{ $ob->slug }}" name="year_to[{{ $ob->id }}]" id="">
                                        <option  value="">--Year to--</option>
                                        @foreach($ob->attribute_years as $attribute_year)
                                            <option   {{ $year->year_to == $attribute_year->year? 'selected' : '' }} value="{{ $attribute_year->year }}">{{ $attribute_year->year }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @endforeach 
                    @endif
                @endif
            </div>

            @if (null !== $ob->engines)
                @foreach($ob->engines as $engine)
                    <div class="children">
                        <div class="d-flex">
                            <div class="form-check">
                                <label  class="custom-control-label" for="{{ $ob->slug }}-{{ $engine->id }}">
                                    <input  
                                         data-name="{{ $ob->slug }}"
                                        class="form-check-input engine-{{ $ob->slug }}" 
                                        value="{{ $engine->id }}" 
                                        type="checkbox" 
                                        id="{{ $ob->slug }}-{{ $engine->id }}" 
                                        name="engine_id[{{ $ob->id }}][]" 
                                        {{ $helper->check($product->engines, $ob->id, true, $engine->id) }} 

                                    >
                                    <span role="button">{{ $engine->name }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @include('includes.children',['obj'=>$ob])
        </div>
    @endforeach
@endif


