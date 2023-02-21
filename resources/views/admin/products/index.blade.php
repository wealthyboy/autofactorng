@extends('admin.layouts.app')
@section('content')

@include('admin._partials.t', ['models' => $products, 'name' => 'Products'])
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop


@section('inline-scripts')




$('#show-panel').on('click', function(e) {
e.preventDefault();
var element = document.getElementById("search-panel");
element.classList.toggle('hide')
})

$("#make_id").on('change', function(e) {
if($(this).val() == ''){return false;}
$.ajax({
url: "/admin/products/search/makemodelyear",
data: $('.filter-form').serialize()
}).then((res) =>{
console.log(res)
$("#model_id").append(res)
}).fail((error) => {

})
})


$("#model_id").on('change', function(e) {
if($(this).val() == ''){return false;}
$.ajax({
url: "/admin/products/search/makemodelyear",
data: $('.filter-form').serialize()
}).then((res) =>{
$("#engine_id").append(res)
}).fail((error) => {

})
})




@stop