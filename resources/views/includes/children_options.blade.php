@foreach($obj->children as $obj)
    @if( isset($model) && $model->parent_id == $obj->id)
        <option   
               {{ isset($disabled) ? 'disabled' : '' }}   
                value="{{ $obj->id }}" 
                selected="selected">
                {{ $obj->name }} 
        </option>
        @include('includes.children_options',['obj'=>$obj,'space'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
    @else
        <option   
            {{ isset($disabled) ?  'disabled' : '' }}  
            value="{{ $obj->id }}"
        >{{ html_entity_decode($space)}}{{ $obj->name }} </option>
        @include('includes.children_options',['obj'=>$obj,'space'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
    @endif
@endforeach