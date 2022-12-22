@foreach($collections as $collection)
<option value="{{ $collection->id }}">{{ $collection->name }} </option>
@endforeach