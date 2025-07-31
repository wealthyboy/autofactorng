@component('mail::message')
# Hey {{ $user->name }}, 

Your cart is still parked, and those parts are itching to get your car back on the road.


@foreach($item->items as $item)
- **{{ $item->name }}**
  <br>
  <img src="{{ $item->image_url }}" width="100">
@endforeach

@component('mail::button', ['url' => route('checkout')])
Return to Checkout
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
