@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h4 class="mb-1">Create ticket</h4><p class="text-sm text-secondary mb-0">Find the order first, confirm its details, then record the complaint.</p></div><a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-dark mb-0">Back to tickets</a></div>
@include('errors.errors')

<form method="post" action="{{ route('admin.tickets.store') }}" id="ticketForm">@csrf
<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card h-100"><div class="card-header pb-0"><h6>1. Find order</h6></div><div class="card-body">
            <label class="form-label">Order ID or invoice number</label>
            <div class="input-group"><input id="orderReference" name="order_reference" value="{{ old('order_reference', $orderReference) }}" class="form-control" required placeholder="e.g. 1250 or AF-INV-1250"><button type="button" id="findOrder" class="btn bg-gradient-dark mb-0">Find order</button></div>
            <p id="orderLookupMessage" class="text-sm mt-2 mb-0"></p>
            <div id="orderPreview" class="border border-radius-lg p-3 mt-3 d-none">
                <div class="d-flex justify-content-between"><strong id="previewInvoice"></strong><a id="previewLink" target="_blank">Open order</a></div>
                <hr class="horizontal dark my-2">
                <div class="text-sm"><strong>Customer:</strong> <span id="previewCustomer"></span></div>
                <div class="text-sm"><strong>Email:</strong> <span id="previewEmail"></span></div>
                <div class="text-sm"><strong>Status:</strong> <span id="previewStatus"></span></div>
                <div class="text-sm"><strong>Total:</strong> <span id="previewTotal"></span></div>
                <div class="text-sm"><strong>Date:</strong> <span id="previewDate"></span></div>
                <div class="text-sm mt-2"><strong>Items:</strong><ul id="previewItems" class="mb-0 ps-4"></ul></div>
            </div>
        </div></div>
    </div>
    <div class="col-lg-7 mb-4">
        <div class="card h-100"><div class="card-header pb-0"><h6>2. Complaint details</h6></div><div class="card-body">
            <label class="form-label">Reason</label>
            <input name="reason" value="{{ old('reason') }}" list="ticketReasons" class="form-control mb-3" required placeholder="Select or enter a reason">
            <datalist id="ticketReasons"><option value="Returned item"><option value="Wrong item delivered"><option value="Damaged item"><option value="Defective product"><option value="Missing item"><option value="Refund request"><option value="Delivery complaint"></datalist>
            <label class="form-label">Message the customer will receive</label>
            <textarea name="comment" rows="7" class="form-control" required>{{ old('comment', 'We have received your complaint and your issue is being addressed. We will keep you informed of any updates.') }}</textarea>
            <p class="text-xs text-secondary mt-2">This message will be emailed to the address attached to the order.</p>
            <button id="createTicketButton" class="btn bg-gradient-dark float-end mt-3 mb-0" disabled>Create ticket and notify customer</button>
        </div></div>
    </div>
</div>
</form>
@endsection

@section('inline-scripts')
const orderReference = document.getElementById('orderReference');
const lookupMessage = document.getElementById('orderLookupMessage');
const preview = document.getElementById('orderPreview');
const submitButton = document.getElementById('createTicketButton');

function setPreviewText(id, value) { document.getElementById(id).textContent = value || '—'; }
async function findTicketOrder() {
    const reference = orderReference.value.trim();
    if (!reference) return;
    lookupMessage.className = 'text-sm text-info mt-2 mb-0';
    lookupMessage.textContent = 'Looking up order…';
    preview.classList.add('d-none');
    submitButton.disabled = true;
    try {
        const response = await fetch(@json(route('admin.tickets.order-preview')) + '?order=' + encodeURIComponent(reference), { headers: { 'Accept': 'application/json' } });
        if (!response.ok) throw new Error(response.status === 404 ? 'Order not found.' : 'Unable to load this order.');
        const order = await response.json();
        setPreviewText('previewInvoice', order.invoice || '#' + order.id);
        setPreviewText('previewCustomer', order.customer);
        setPreviewText('previewEmail', order.email);
        setPreviewText('previewStatus', order.status);
        setPreviewText('previewTotal', order.total);
        setPreviewText('previewDate', order.date);
        const items = document.getElementById('previewItems'); items.innerHTML = '';
        order.items.forEach(function (item) { const li = document.createElement('li'); li.textContent = item.name + ' × ' + item.quantity; items.appendChild(li); });
        document.getElementById('previewLink').href = order.show_url;
        lookupMessage.className = 'text-sm text-success mt-2 mb-0'; lookupMessage.textContent = 'Order found. Please confirm the details below.';
        preview.classList.remove('d-none'); submitButton.disabled = false;
    } catch (error) {
        lookupMessage.className = 'text-sm text-danger mt-2 mb-0'; lookupMessage.textContent = error.message;
    }
}
document.getElementById('findOrder').addEventListener('click', findTicketOrder);
orderReference.addEventListener('keydown', function (event) { if (event.key === 'Enter') { event.preventDefault(); findTicketOrder(); } });
if (orderReference.value.trim()) findTicketOrder();
@endsection
