@extends('admin.layouts.app')
@section('content')

@include('admin._partials.t', ['models' => $products, 'name' => 'Products'])
</div>
@endsection


@section('inline-scripts')

$('.update_price').on('blur', function(e) {
let self = $(this);
$.ajax({
url: "/admin/products/update-price/" + self.data('id'),
method: "POST",
data: {price: self.html(), 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
}).then((res) =>{
alert("Price Updated")
}).fail((error) => {
alert("Something went wrong")

})
})


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