@extends('admin.layouts.app')
@section('content')

@include('admin._partials.t', ['models' => $products, 'name' => 'Products'])
</div>
@endsection


@section('inline-scripts')
$('#show-panel').on('click', function(e) {
e.preventDefault();
console.log(e)
var element = document.getElementById("search-panel");
element.classList.toggle('hide')
})
@stop