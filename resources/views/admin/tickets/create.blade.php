@extends('admin.layouts.app')

@section('page-styles')
@include('admin.tickets._styles')
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Create ticket</h4>
        <p class="text-sm text-secondary mb-0">Find the order, select the returned items, then choose how the complaint should be handled.</p>
    </div>
    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-dark mb-0">Back to tickets</a>
</div>

@include('errors.errors')

<form method="post" action="{{ route('admin.tickets.store') }}" id="ticketForm">
@csrf
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card ticket-form-card h-100">
            <div class="card-header pb-0"><h6>1. Order & returned items</h6></div>
            <div class="card-body">
                <label class="ticket-form-label" for="orderReference">Order ID or invoice number</label>
                <div class="input-group ticket-order-group">
                    <input id="orderReference" name="order_reference" value="{{ old('order_reference', $orderReference) }}" class="form-control ticket-control" required placeholder="e.g. 1250 or AF-INV-1250">
                    <button type="button" id="findOrder" class="btn bg-gradient-dark mb-0 px-4">Find order</button>
                </div>

                <p id="orderLookupMessage" class="text-sm mt-2 mb-0"></p>

                <div id="orderPreview" class="ticket-preview p-3 mt-3 d-none">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong id="previewInvoice"></strong>
                        <a id="previewLink" target="_blank">Open order</a>
                    </div>
                    <hr class="horizontal dark my-2">
                    <div class="text-sm"><strong>Customer:</strong> <span id="previewCustomer"></span></div>
                    <div class="text-sm"><strong>Email:</strong> <span id="previewEmail"></span></div>
                    <div class="text-sm"><strong>Status:</strong> <span id="previewStatus"></span></div>
                    <div class="text-sm"><strong>Order total:</strong> <span id="previewTotal"></span></div>
                    <div class="text-sm"><strong>Date:</strong> <span id="previewDate"></span></div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-sm">Select items being returned</strong>
                            <span class="text-xs text-secondary">Quantity cannot exceed order quantity</span>
                        </div>
                        <div id="previewItems"></div>
                    </div>

                    <div class="ticket-return-total mt-3 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-weight-bold">Selected return total</span>
                            <strong id="selectedReturnTotal">₦0.00</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card ticket-form-card h-100">
            <div class="card-header pb-0"><h6>2. Ticket details</h6></div>
            <div class="card-body">
                <label class="ticket-form-label" for="ticketDepartment">Department</label>
                <select id="ticketDepartment" name="department" class="form-control ticket-control mb-3" required>
                    <option value="">Select department</option>
                    @foreach(\App\Models\Ticket::DEPARTMENTS as $department)
                        <option value="{{ $department }}" @if(old('department') === $department) selected @endif>{{ $department }}</option>
                    @endforeach
                </select>

                <label class="ticket-form-label" for="ticketCategory">Category</label>
                <select id="ticketCategory" name="category" class="form-control ticket-control mb-3" required>
                    <option value="">Select category</option>
                    @foreach(\App\Models\Ticket::CATEGORIES as $category)
                        <option value="{{ $category }}" @if(old('category') === $category) selected @endif>{{ $category }}</option>
                    @endforeach
                </select>

                <label class="ticket-form-label" for="ticketReason">Reason</label>
                <select id="ticketReason" name="reason" class="form-control ticket-control mb-3" required>
                    <option value="">Select reason</option>
                    @foreach(\App\Models\Ticket::REASONS as $reason)
                        <option value="{{ $reason }}" @if(old('reason') === $reason) selected @endif>{{ $reason }}</option>
                    @endforeach
                </select>

                <div id="refundFields" class="ticket-dynamic-panel d-none mb-3">
                    <h6 class="text-sm mb-3">Refund details</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="ticket-form-label" for="accountName">Account Name</label>
                            <input id="accountName" name="account_name" value="{{ old('account_name') }}" class="form-control ticket-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="ticket-form-label" for="accountNumber">Account Number</label>
                            <input id="accountNumber" name="account_number" value="{{ old('account_number') }}" class="form-control ticket-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="ticket-form-label" for="bankName">Bank Name</label>
                            <input id="bankName" name="bank_name" value="{{ old('bank_name') }}" class="form-control ticket-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="ticket-form-label" for="refundAmount">Amount</label>
                            <input id="refundAmount" class="form-control ticket-control" value="₦0.00" disabled>
                        </div>
                    </div>
                </div>

                <div id="walletFields" class="ticket-dynamic-panel d-none mb-3">
                    <h6 class="text-sm mb-3">Wallet details</h6>
                    <label class="ticket-form-label" for="walletSource">Order type</label>
                    <select id="walletSource" name="wallet_source" class="form-control ticket-control">
                        <option value="">Select</option>
                        @foreach(\App\Models\Ticket::WALLET_SOURCES as $source)
                            <option value="{{ $source }}" @if(old('wallet_source') === $source) selected @endif>{{ $source }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="emailPreviewPanel" class="ticket-email-preview d-none p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-sm">Customer email preview</strong>
                        <span id="emailCategoryBadge" class="badge bg-gradient-info"></span>
                    </div>
                    <div id="emailPreview" class="text-sm" style="white-space: pre-line"></div>
                </div>

                <p class="text-xs text-secondary mb-0">The customer name and generated ticket number will be inserted automatically when the ticket is created.</p>
                <button id="createTicketButton" class="btn bg-gradient-dark float-end mt-3 mb-0" disabled>Create ticket and notify customer</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('inline-scripts')
const orderReference = document.getElementById('orderReference');
const lookupMessage = document.getElementById('orderLookupMessage');
const preview = document.getElementById('orderPreview');
const submitButton = document.getElementById('createTicketButton');
const categorySelect = document.getElementById('ticketCategory');
const refundFields = document.getElementById('refundFields');
const walletFields = document.getElementById('walletFields');
const emailPreviewPanel = document.getElementById('emailPreviewPanel');
const emailPreview = document.getElementById('emailPreview');
const emailCategoryBadge = document.getElementById('emailCategoryBadge');
const selectedReturnTotal = document.getElementById('selectedReturnTotal');
const refundAmount = document.getElementById('refundAmount');
let loadedOrder = null;

function setPreviewText(id, value) {
    document.getElementById(id).textContent = value || '—';
}

function money(value) {
    return '₦' + Number(value || 0).toLocaleString('en-NG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function selectedTotal() {
    let total = 0;
    document.querySelectorAll('.ticket-item-checkbox:checked').forEach(function (checkbox) {
        const row = checkbox.closest('.ticket-return-item');
        const quantity = Number(row.querySelector('.ticket-return-quantity').value || 0);
        const unitPrice = Number(row.dataset.unitPrice || 0);
        total += quantity * unitPrice;
    });

    selectedReturnTotal.textContent = money(total);
    refundAmount.value = money(total);
    return total;
}

function refreshSubmitState() {
    const hasOrder = !!loadedOrder;
    const hasSelectedItem = document.querySelectorAll('.ticket-item-checkbox:checked').length > 0;
    submitButton.disabled = !(hasOrder && hasSelectedItem);
}

function renderItems(items) {
    const container = document.getElementById('previewItems');
    container.innerHTML = '';

    items.forEach(function (item) {
        const row = document.createElement('div');
        row.className = 'ticket-return-item p-2 mb-2';
        row.dataset.unitPrice = item.unit_price;

        let options = '';
        for (let quantity = 1; quantity <= item.quantity; quantity++) {
            options += '<option value="' + quantity + '">' + quantity + '</option>';
        }

        row.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="form-check me-3 mt-1">
                    <input class="form-check-input ticket-item-checkbox" type="checkbox" name="items[${item.id}][selected]" value="1" id="ticketItem${item.id}">
                </div>
                <div class="flex-grow-1">
                    <label for="ticketItem${item.id}" class="text-sm font-weight-bold mb-1 d-block">${item.name}</label>
                    <div class="text-xs text-secondary">Ordered: ${item.quantity} &nbsp;•&nbsp; Unit price: ${item.unit_price_formatted}</div>
                </div>
                <div class="ms-3" style="min-width: 90px;">
                    <label class="text-xs text-secondary mb-1">Return qty</label>
                    <select name="items[${item.id}][quantity]" class="form-control ticket-control ticket-return-quantity" disabled>${options}</select>
                </div>
            </div>`;

        container.appendChild(row);
    });

    container.querySelectorAll('.ticket-item-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const quantity = checkbox.closest('.ticket-return-item').querySelector('.ticket-return-quantity');
            quantity.disabled = !checkbox.checked;
            selectedTotal();
            refreshSubmitState();
        });
    });

    container.querySelectorAll('.ticket-return-quantity').forEach(function (select) {
        select.addEventListener('change', selectedTotal);
    });

    selectedTotal();
    refreshSubmitState();
}

function customerName() {
    return loadedOrder && loadedOrder.customer ? loadedOrder.customer : 'Valued Customer';
}

function updateCategoryForm() {
    const category = categorySelect.value;
    refundFields.classList.toggle('d-none', category !== 'Refund');
    walletFields.classList.toggle('d-none', category !== 'Wallet');

    document.getElementById('accountName').required = category === 'Refund';
    document.getElementById('accountNumber').required = category === 'Refund';
    document.getElementById('bankName').required = category === 'Refund';
    document.getElementById('walletSource').required = category === 'Wallet';

    if (!category) {
        emailPreviewPanel.classList.add('d-none');
        return;
    }

    const name = customerName();
    let message = '';

    if (category === 'Refund') {
        message = `Dear ${name},\n\nYour refund request has been submitted to our Finance Team for processing. Once approved, the refund will be credited to your account within 3–5 working days.\n\nYou will receive a confirmation email once the refund is processed.\n\nKind regards,\nCustomer Support Team`;
    } else if (category === 'Wallet') {
        message = `Dear ${name},\n\nThank you for your patience.\n\nWe wish to inform you that your wallet credit request has been submitted to our Finance Team for processing. Once approved, the value of the item will be credited to your store wallet.\n\nYou will receive a confirmation email once the wallet credit has been successfully applied to your account.\n\nIf you have any questions or require further assistance, please feel free to contact our Customer Support Team.\n\nKind regards,\nCustomer Support Team`;
    } else {
        message = `Dear ${name},\n\nThank you for contacting us.\n\nYour enquiry/complaint has been logged and escalated to the appropriate team for review. We will update you via email once we have an outcome.\n\nYour Ticket Number will be inserted automatically.\n\nThank you for your patience and understanding.\n\nKind regards,\nCustomer Support Team`;
    }

    emailCategoryBadge.textContent = category;
    emailPreview.textContent = message;
    emailPreviewPanel.classList.remove('d-none');
    selectedTotal();
}

async function findTicketOrder() {
    const reference = orderReference.value.trim();
    if (!reference) return;

    lookupMessage.className = 'text-sm text-info mt-2 mb-0';
    lookupMessage.textContent = 'Looking up order…';
    preview.classList.add('d-none');
    submitButton.disabled = true;
    loadedOrder = null;

    try {
        const response = await fetch(@json(route('admin.tickets.order-preview')) + '?order=' + encodeURIComponent(reference), {
            headers: { 'Accept': 'application/json' }
        });

        if (!response.ok) {
            throw new Error(response.status === 404 ? 'Order not found.' : 'Unable to load this order.');
        }

        const order = await response.json();
        loadedOrder = order;

        setPreviewText('previewInvoice', order.invoice || '#' + order.id);
        setPreviewText('previewCustomer', order.customer);
        setPreviewText('previewEmail', order.email);
        setPreviewText('previewStatus', order.status);
        setPreviewText('previewTotal', order.total);
        setPreviewText('previewDate', order.date);
        document.getElementById('previewLink').href = order.show_url;

        renderItems(order.items || []);
        updateCategoryForm();

        lookupMessage.className = 'text-sm text-success mt-2 mb-0';
        lookupMessage.textContent = 'Order found. Select the item(s) the customer is returning.';
        preview.classList.remove('d-none');
    } catch (error) {
        lookupMessage.className = 'text-sm text-danger mt-2 mb-0';
        lookupMessage.textContent = error.message;
    }
}

document.getElementById('findOrder').addEventListener('click', findTicketOrder);
categorySelect.addEventListener('change', updateCategoryForm);
orderReference.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        findTicketOrder();
    }
});

updateCategoryForm();
if (orderReference.value.trim()) findTicketOrder();
@endsection
