@foreach($obj->children->sortBy('name') as $obj)
    <div class="children" value="{{ $obj->id }}">

        <div class="form-check">
            <input  class="form-check-input" value="{{ $obj->id }}" type="checkbox" id="customCheck5">
            <label  class="custom-control-label" for="customCheck1">
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
        @include('includes.children',['obj'=>$obj])
    </div>
@endforeach