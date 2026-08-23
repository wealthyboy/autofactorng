@extends('admin.layouts.app')

@section('page-styles')
@include('admin.tickets._styles')
@endsection

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">{{ $ticket->ticket_number }}</h4>
        <p class="text-sm text-secondary mb-0">Created {{ optional($ticket->created_at)->format('d M Y, h:i A') }} by {{ optional($ticket->creator)->name ?: 'Admin' }}</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        @if($ticket->status !== 'Closed')
        <form method="post" action="{{ route('admin.tickets.close', $ticket) }}" onsubmit="return confirm('Close this ticket and send the category resolution email to the customer?')">
            @csrf
            <button class="btn bg-gradient-danger mb-0">Close ticket</button>
        </form>
        @endif
        <a href="{{ route('admin.tickets.create', ['order' => $ticket->order_id]) }}" class="btn btn-outline-dark mb-0">New ticket for order</a>
        <a href="{{ route('admin.tickets.index') }}" class="btn bg-gradient-dark mb-0">All tickets</a>
    </div>
</div>

@if(session('success'))<div class="alert alert-success text-white">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger text-white">{{ session('error') }}</div>@endif

<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Ticket details</h6></div>
            <div class="card-body">
                <p class="text-sm mb-2"><strong>Status:</strong> <span class="badge bg-gradient-{{ in_array($ticket->status, ['Resolved', 'Closed']) ? 'success' : ($ticket->status === 'In Progress' ? 'info' : 'warning') }}">{{ $ticket->status }}</span></p>
                <p class="text-sm mb-2"><strong>Department:</strong> {{ $ticket->department ?: '—' }}</p>
                <p class="text-sm mb-2"><strong>Reason:</strong> {{ $ticket->reason }}</p>
                <p class="text-sm mb-2"><strong>Category:</strong> {{ $ticket->category ?: '—' }}</p>
                <p class="text-sm mb-0"><strong>Return total:</strong> ₦{{ number_format((float) $ticket->return_total, 2) }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Additional Information</h6></div>
            <div class="card-body">
                <p class="text-sm text-secondary mb-0" style="white-space: pre-line">{{ $ticket->additional_information ?: 'No additional information was provided.' }}</p>
            </div>
        </div>

        @if($ticket->category === 'Refund')
        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Refund details</h6></div>
            <div class="card-body">
                <p class="text-sm mb-2"><strong>Account Name:</strong> {{ $ticket->account_name ?: '—' }}</p>
                <p class="text-sm mb-2"><strong>Account Number:</strong> {{ $ticket->account_number ?: '—' }}</p>
                <p class="text-sm mb-2"><strong>Bank Name:</strong> {{ $ticket->bank_name ?: '—' }}</p>
                <p class="text-sm mb-0"><strong>Amount:</strong> ₦{{ number_format((float) $ticket->return_total, 2) }}</p>
            </div>
        </div>
        @elseif($ticket->category === 'Wallet')
        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Wallet details</h6></div>
            <div class="card-body">
                <p class="text-sm mb-2"><strong>Order type:</strong> {{ $ticket->wallet_source ?: '—' }}</p>
                <p class="text-sm mb-0"><strong>Amount:</strong> ₦{{ number_format((float) $ticket->return_total, 2) }}</p>
            </div>
        </div>
        @elseif(in_array($ticket->reason, ['Over Payment', 'Double Payment']))
        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Payment details</h6></div>
            <div class="card-body">
                <p class="text-sm mb-2"><strong>Reason:</strong> {{ $ticket->reason }}</p>
                <p class="text-sm mb-0"><strong>Amount:</strong> ₦{{ number_format((float) $ticket->return_total, 2) }}</p>
            </div>
        </div>
        @endif

        @if($ticket->requiresPaymentApproval())
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Payment approval</h6>
                @if($ticket->approved_at)
                    <span class="badge bg-gradient-success">Approved</span>
                @else
                    <span class="badge bg-gradient-warning">Pending approval</span>
                @endif
            </div>
            <div class="card-body">
                @if($ticket->approved_at)
                    <p class="text-sm mb-2"><strong>Approval Date:</strong> {{ $ticket->approved_at->format('d M Y') }}</p>
                    <p class="text-sm mb-0"><strong>Approved By:</strong> {{ optional($ticket->approver)->name ?: 'Admin' }}</p>
                @else
                    <p class="text-sm text-secondary">This payment is awaiting approval. Select the approval date before approving.</p>
                    <form method="post" action="{{ route('admin.tickets.approve-payment', $ticket) }}" onsubmit="return confirm('Approve this payment using the selected approval date?')">
                        @csrf
                        <div class="mb-3">
                            <label class="ticket-form-label" for="approvalDate">Approval Date</label>
                            <input
                                id="approvalDate"
                                type="date"
                                name="approval_date"
                                value="{{ old('approval_date', now()->format('Y-m-d')) }}"
                                class="form-control ticket-control"
                                required
                            >
                        </div>
                        <button class="btn bg-gradient-success mb-0">Approve Payment</button>
                    </form>
                @endif
            </div>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Returned items</h6></div>
            <div class="card-body">
                @forelse($ticket->items as $item)
                    <div class="ticket-return-item p-3 mb-2">
                        <div class="font-weight-bold text-sm">{{ $item->product_name }}</div>
                        <div class="text-xs text-secondary mt-1">Qty: {{ $item->quantity }} × ₦{{ number_format((float) $item->unit_price, 2) }}</div>
                        <div class="text-sm mt-1"><strong>₦{{ number_format((float) $item->total, 2) }}</strong></div>
                    </div>
                @empty
                    <p class="text-sm text-secondary mb-0">No returned items were recorded.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header pb-0"><h6>Related order</h6></div>
            <div class="card-body">
                <a href="{{ route('admin.orders.show', $ticket->order_id) }}" class="font-weight-bold">{{ $ticket->order->invoice ?: '#' . $ticket->order_id }} <i class="material-symbols-outlined text-sm">open_in_new</i></a>
                <p class="text-sm mt-3 mb-1"><strong>Customer:</strong> {{ trim($ticket->order->fullName()) ?: optional($ticket->order->user)->fullname() }}</p>
                <p class="text-sm mb-1"><strong>Email:</strong> {{ $ticket->order->email ?: optional($ticket->order->orderEmail)->email ?: optional($ticket->order->user)->email ?: 'Not available' }}</p>
                <p class="text-sm mb-1"><strong>Order status:</strong> {{ $ticket->order->status }}</p>
                <p class="text-sm mb-3"><strong>Order total:</strong> ₦{{ number_format((float) $ticket->order->total, 2) }}</p>
                <strong class="text-sm">Order items</strong>
                <ul class="text-sm ps-4 mb-0">
                    @foreach($ticket->order->ordered_products as $item)
                        <li>{{ $item->product_name }} × {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-4">
        <div class="card mb-4">
            <div class="card-header pb-0"><h6>Conversation</h6></div>
            <div class="card-body">
                @forelse($ticket->comments as $comment)
                    <div class="border-start border-3 {{ $comment->customer_visible ? 'border-info' : 'border-secondary' }} ps-3 mb-4">
                        <div class="d-flex justify-content-between">
                            <strong class="text-sm">{{ optional($comment->creator)->name ?: 'Admin' }}</strong>
                            <span class="text-xs text-secondary">{{ optional($comment->created_at)->format('d M Y, h:i A') }}</span>
                        </div>
                        <p class="text-sm my-2" style="white-space: pre-line">{{ $comment->comment }}</p>
                        <span class="badge badge-sm bg-gradient-{{ $comment->customer_visible ? 'info' : 'secondary' }}">{{ $comment->customer_visible ? 'Sent to customer' : 'Internal note' }}</span>
                    </div>
                @empty
                    <p class="text-sm text-secondary">No comments yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card ticket-form-card">
            <div class="card-header pb-0"><h6>Add update</h6></div>
            <div class="card-body">
                @include('errors.errors')
                <form method="post" action="{{ route('admin.tickets.comments.store', $ticket) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="ticket-form-label" for="ticketStatus">Status</label>
                            @if($ticket->status === 'Closed')
                                <input type="hidden" name="status" value="Closed">
                                <select id="ticketStatus" class="form-control ticket-control" disabled>
                                    <option selected>Closed</option>
                                </select>
                            @else
                                <select id="ticketStatus" name="status" class="form-control ticket-control">
                                    @foreach(array_values(array_diff(\App\Models\Ticket::STATUSES, ['Closed'])) as $status)
                                        <option value="{{ $status }}" @if($ticket->status === $status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <label class="ticket-form-label" for="ticketComment">Comment</label>
                    <textarea id="ticketComment" name="comment" rows="5" class="form-control ticket-control" required placeholder="Write an update about this complaint…">{{ old('comment') }}</textarea>
                    <input type="hidden" name="customer_visible" value="0">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" name="customer_visible" value="1" id="customerVisible" checked>
                        <label class="form-check-label text-sm" for="customerVisible">Email this update to the customer</label>
                    </div>
                    <p class="text-xs text-secondary mt-2 mb-0">Customer-visible updates are emailed as ticket updates. To close the ticket and send the final resolution email, use the Close ticket button at the top of this page.</p>
                    <button class="btn bg-gradient-dark float-end mt-3 mb-0">Save update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
