@extends('admin.layouts.app')
@section('content')

@include('admin._partials.t', ['models' => $products, 'name' => 'Products'])
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop

@section('page-styles')
<style>
    .product-featured-switch {
        position: relative;
        display: inline-flex;
        width: 42px;
        height: 24px;
        flex: 0 0 42px;
        cursor: pointer;
    }

    .product-featured-switch input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
    }

    .product-featured-slider {
        position: absolute;
        inset: 0;
        border-radius: 999px;
        background: #d7dce3;
        transition: background-color .2s ease, opacity .2s ease;
    }

    .product-featured-slider::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .22);
        transition: transform .2s ease;
    }

    .product-featured-switch input:checked + .product-featured-slider {
        background: #e91e63;
    }

    .product-featured-switch input:checked + .product-featured-slider::after {
        transform: translateX(18px);
    }

    .product-featured-switch input:focus-visible + .product-featured-slider {
        box-shadow: 0 0 0 3px rgba(233, 30, 99, .2);
    }

    .product-featured-switch input:disabled + .product-featured-slider {
        cursor: wait;
        opacity: .55;
    }
</style>
@stop


@section('inline-scripts')


$(document).on('change', '.js-product-featured-toggle', function () {
    const toggle = $(this);
    const label = toggle.closest('.product-featured-control').find('.js-product-featured-label');
    const productId = toggle.data('product-id');
    const isFeatured = toggle.is(':checked');

    toggle.prop('disabled', true);
    label.text('Saving...');

    $.ajax({
        url: '/admin/products/' + productId + '/featured',
        method: 'POST',
        data: {
            is_featured: isFeatured ? 1 : 0,
            _token: $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function (response) {
        const savedState = Boolean(response.is_featured);
        toggle.prop('checked', savedState);
        label.text(savedState ? 'Featured' : 'Standard');
    }).fail(function (xhr) {
        toggle.prop('checked', !isFeatured);
        label.text(!isFeatured ? 'Featured' : 'Standard');

        const message = xhr.responseJSON && xhr.responseJSON.message
            ? xhr.responseJSON.message
            : 'The featured status could not be saved. Please try again.';

        alert(message);
    }).always(function () {
        toggle.prop('disabled', false);
    });
});




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
