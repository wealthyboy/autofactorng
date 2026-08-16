@extends('admin.layouts.app')
@section('content')

@include('admin._partials.t', ['models' => $products, 'name' => 'Products'])

<div class="modal fade" id="stockAdjustmentModal" tabindex="-1" aria-labelledby="stockAdjustmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:20px;">
            <form id="stock-adjustment-form">
                @csrf
                <div class="modal-header border-0 px-4 pt-4">
                    <div>
                        <h5 class="modal-title" id="stockAdjustmentModalLabel">Adjust stock quantity</h5>
                        <p class="text-sm text-muted mb-0" id="stock-adjustment-product-name"></p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="rounded-3 bg-light p-3 mb-3">
                        Current quantity: <strong id="stock-adjustment-current-quantity">0</strong>
                    </div>
                    <input type="hidden" id="stock-adjustment-product-id">
                    <input type="hidden" id="stock-adjustment-operation" name="operation" value="increase">
                    <div class="mb-3">
                        <label class="form-label" for="stock-adjustment-quantity">New quantity</label>
                        <input class="form-control border rounded-3 px-3" id="stock-adjustment-quantity" name="quantity" type="number" min="1" step="1" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="stock-adjustment-reason">Reason</label>
                        <select class="form-control border rounded-3 px-3" id="stock-adjustment-reason" name="reason" required>
                            <option value="">Select a reason</option>
                            <option value="stock_purchase">Stock purchase</option>
                            <option value="returned_item">Returned item</option>
                        </select>
                    </div>
                    <div class="alert alert-danger d-none mt-3 mb-0" id="stock-adjustment-error"></div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-gradient-dark rounded-3" id="stock-adjustment-submit">Update quantity</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js?id='.rand(5353535, 2)) }}"></script>
@stop


@section('inline-scripts')




$('#show-panel').on('click', function(e) {
e.preventDefault();
var element = document.getElementById("search-panel");
element.classList.toggle('hide')
})

const stockAdjustmentElement = document.getElementById('stockAdjustmentModal');
const stockAdjustmentModal = stockAdjustmentElement ? new bootstrap.Modal(stockAdjustmentElement) : null;
let activeStockButton = null;

document.addEventListener('click', function (event) {
    const button = event.target.closest('.adjust-stock-button');
    if (!button || !stockAdjustmentModal) return;

    activeStockButton = button;
    document.getElementById('stock-adjustment-product-id').value = button.dataset.productId;
    document.getElementById('stock-adjustment-product-name').textContent = button.dataset.productName;
    document.getElementById('stock-adjustment-current-quantity').textContent = button.dataset.productQuantity;
    const quantityInput = document.getElementById('stock-adjustment-quantity');
    const minimumQuantity = Number(button.dataset.productQuantity) + 1;
    quantityInput.value = '';
    quantityInput.min = minimumQuantity;
    quantityInput.setCustomValidity('');
    document.getElementById('stock-adjustment-reason').value = '';
    document.getElementById('stock-adjustment-operation').value = 'increase';
    document.getElementById('stock-adjustment-error').classList.add('d-none');
    stockAdjustmentModal.show();
});

document.getElementById('stock-adjustment-form')?.addEventListener('submit', function (event) {
    event.preventDefault();
    const productId = document.getElementById('stock-adjustment-product-id').value;
    const submitButton = document.getElementById('stock-adjustment-submit');
    const errorBox = document.getElementById('stock-adjustment-error');
    const payload = new FormData(event.target);
    const quantityInput = document.getElementById('stock-adjustment-quantity');
    const currentQuantity = Number(activeStockButton.dataset.productQuantity);

    if (Number(quantityInput.value) <= currentQuantity) {
        quantityInput.setCustomValidity('New quantity must be greater than the current quantity.');
        quantityInput.reportValidity();
        return;
    }

    quantityInput.setCustomValidity('');

    submitButton.disabled = true;
    errorBox.classList.add('d-none');

    fetch('/admin/products/' + productId + '/adjust-stock', {
        method: 'POST',
        body: payload,
        headers: { 'Accept': 'application/json' }
    }).then(async function (response) {
        const data = await response.json().catch(function () { return {}; });
        if (!response.ok) throw new Error(data.message || Object.values(data.errors || {}).flat()[0] || 'Quantity could not be updated.');
        return data;
    }).then(function (data) {
        activeStockButton.dataset.productQuantity = data.quantity;
        activeStockButton.querySelector('.stock-quantity-value').textContent = data.quantity;
        stockAdjustmentModal.hide();
    }).catch(function (error) {
        errorBox.textContent = error.message;
        errorBox.classList.remove('d-none');
    }).finally(function () {
        submitButton.disabled = false;
    });
});

document.getElementById('stock-adjustment-quantity')?.addEventListener('input', function () {
    const currentQuantity = Number(activeStockButton?.dataset.productQuantity || 0);
    this.setCustomValidity(Number(this.value) > currentQuantity
        ? ''
        : 'New quantity must be greater than the current quantity.');
});

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
