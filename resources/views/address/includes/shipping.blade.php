@foreach($location->shipping as $shipping)
   <option value="" selected="selected">Choose a shipping</option> 
   <option value="{{ $shipping->id }}">{{ $shipping->name }} ₦{{ number_format($shipping->price) }}</option>
@endforeach
