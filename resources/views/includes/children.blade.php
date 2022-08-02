@if (optional($obj)->children)
    @foreach($obj->children->sortBy('name') as $ob)
        <div class="children" value="{{ $ob->id }}">
            <div class="d-flex">
                <div class="form-check">
                    <label  class="custom-control-label" for="{{ $ob->slug }}-{{ $ob->id }}">
                        <input  class="form-check-input car-models {{$url}} {{ $obj->slug }} {{ $obj->name == 'Spare Parts' || $obj->name == 'Servicing Parts'  ? 'no-validation' : '' }}" value="{{ $ob->id }}"  data-slug="{{ $ob->slug }}"  data-name="{{ $ob->name }}" type="checkbox" id="{{ $ob->slug }}-{{ $ob->id }}" name="{{$name}}[]" >
                        <span role="button">{{ $ob->name }}</span>
                        <a href="{{ route($route.'.edit',[$url => $ob->id]) }}">
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
                
                    @if(null !== $ob->attribute_years)
                        <div class="col-sm-3 ml-3 col-12">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label "> </label>
                                <select class="form-control mx-3 year Year_from-{{ $ob->slug }}" name="year_from[{{ $ob->id }}]" id="">
                                    <option  value="">--Year from--</option>
                                    @foreach($ob->attribute_years as $attribute_year)
                                        <option  value="{{ $attribute_year->year }}">{{ $attribute_year->year }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 ml-3 col-12">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label "> </label>
                                <select class="form-control year Year_to-{{ $ob->slug }}" name="year_to[{{ $ob->id }}]" id="">
                                    <option  value="">--Year to--</option>
                                    @foreach($ob->attribute_years as $attribute_year)
                                        <option class="" value="{{ $attribute_year->year }}" >{{ $attribute_year->year }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                @endif


            </div>

            @if (isset($engine) && $engine && null !== $ob->engines)
                @foreach($ob->engines as $engine)
                <div class="children" value="{{ $engine->id }}">
                    <div class="d-flex">
                        <div class="form-check">
                            <label  class="custom-control-label " for="{{ $ob->slug }}-{{ $engine->id }}">
                                <input  
                                    class="form-check-input  engine-{{ $ob->slug }}" 
                                    value="{{ $engine->id }}" 
                                    type="checkbox" 
                                    id="{{ $ob->slug }}-{{ $engine->id }}" 
                                    name="engine_id[{{ $ob->id }}][]" 
                                    data-slug="{{ $ob->slug }}"
                                    data-name="{{ $ob->name }}"
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