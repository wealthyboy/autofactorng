@foreach($country->children as $state)
   <option value="" selected="selected">Choose a state</option> 
   <option value="{{ $state->id }}">{{ $state->name }}</option>
@endforeach
