@foreach($attribute->children as $attribute)
    <option  {{ isset($disabled) ? 'disabled' : '' }}   value="{{ $attribute->id }}">&nbsp;&nbsp;&nbsp;{{ $attribute->name }} </option>
    @include('includes.product_attr',['attribute'=>$attribute])
@endforeach