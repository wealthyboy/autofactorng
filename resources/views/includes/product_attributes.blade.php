@foreach($product_attributes->children as $product_attribute)
    <div class="product_attributes" value="{{ $product_attribute->id }}">{{ $product_attribute->name }} 
      <a href="{{ route('edit_attribute',['id'=>$product_attribute->id]) }}"><i class="fa fa-pencil"></i> Edit</a> | <a href="{{  route('delete_attribute',['id'=>$product_attribute->id]) }}">  <i class="fa fa-trash"></i> Delete</a>
     @include('includes.product_attributes',['product_attributes'=>$product_attribute])
    </div>
@endforeach

