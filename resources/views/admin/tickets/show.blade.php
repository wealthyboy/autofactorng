@extends('admin.layouts.app')

@section('page-styles')
@include('admin.tickets._styles')
@endsection

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div><h4 class="mb-1">{{ $ticket->ticket_number }}</h4><p class="text-sm text-secondary mb-0">Created {{ optional($ticket->created_at)->format('d M Y, h:i A') }} by {{ optional($ticket->creator)->name ?: 'Admin' }}</p></div>
    <div><a href="{{ route('admin.tickets.create', ['order' => $ticket->order_id]) }}" class="btn btn-outline-dark mb-0 me-2">New ticket for order</a><a href="{{ route('admin.tickets.index') }}" class="btn bg-gradient-dark mb-0">All tickets</a></div>
</div>
@if(session('success'))<div class="alert alert-success text-white">{{ session('success') }}</div>@endif

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card mb-4"><div class="card-header pb-0"><h6>Ticket details</h6></div><div class="card-body">
            <p class="text-sm mb-2"><strong>Status:</strong> <span class="badge bg-gradient-{{ in_array($ticket->status, ['Resolved', 'Closed']) ? 'success' : ($ticket->status === 'In Progress' ? 'info' : 'warning') }}">{{ $ticket->status }}</span></p>
            <p class="text-sm mb-0"><strong>Reason:</strong> {{ $ticket->reason }}</p>
        </div></div>
        <div class="card"><div class="card-header pb-0"><h6>Related order</h6></div><div class="card-body">
            <a href="{{ route('admin.orders.show', $ticket->order_id) }}" class="font-weight-bold">{{ $ticket->order->invoice ?: '#' . $ticket->order_id }} <i class="material-symbols-outlined text-sm">open_in_new</i></a>
            <p class="text-sm mt-3 mb-1"><strong>Customer:</strong> {{ trim($ticket->order->fullName()) ?: optional($ticket->order->user)->fullname() }}</p>
            <p class="text-sm mb-1"><strong>Email:</strong> {{ $ticket->order->email ?: optional($ticket->order->orderEmail)->email ?: optional($ticket->order->user)->email ?: 'Not available' }}</p>
            <p class="text-sm mb-1"><strong>Order status:</strong> {{ $ticket->order->status }}</p>
            <p class="text-sm mb-3"><strong>Total:</strong> ₦{{ number_format((float) $ticket->order->total, 2) }}</p>
            <strong class="text-sm">Items</strong><ul class="text-sm ps-4 mb-0">@foreach($ticket->order->ordered_products as $item)<li>{{ $item->product_name }} × {{ $item->quantity }}</li>@endforeach</ul>
        </div></div>
    </div>
    <div class="col-lg-8 mb-4">
        <div class="card mb-4"><div class="card-header pb-0"><h6>Conversation</h6></div><div class="card-body">
            @forelse($ticket->comments as $comment)
                <div class="border-start border-3 {{ $comment->customer_visible ? 'border-info' : 'border-secondary' }} ps-3 mb-4">
                    <div class="d-flex justify-content-between"><strong class="text-sm">{{ optional($comment->creator)->name ?: 'Admin' }}</strong><span class="text-xs text-secondary">{{ optional($comment->created_at)->format('d M Y, h:i A') }}</span></div>
                    <p class="text-sm my-2" style="white-space: pre-line">{{ $comment->comment }}</p>
                    <span class="badge badge-sm bg-gradient-{{ $comment->customer_visible ? 'info' : 'secondary' }}">{{ $comment->customer_visible ? 'Sent to customer' : 'Internal note' }}</span>
                </div>
            @empty<p class="text-sm text-secondary">No comments yet.</p>@endforelse
        </div></div>
        <div class="card ticket-form-card"><div class="card-header pb-0"><h6>Add update</h6></div><div class="card-body">
            @include('errors.errors')
            <form method="post" action="{{ route('admin.tickets.comments.store', $ticket) }}">@csrf
                <div class="row"><div class="col-md-4 mb-3"><label class="ticket-form-label" for="ticketStatus">Status</label><select id="ticketStatus" name="status" class="form-control ticket-control">@foreach(\App\Models\Ticket::STATUSES as $status)<option value="{{ $status }}" @if($ticket->status === $status) selected @endif>{{ $status }}</option>@endforeach</select></div></div>
                <label class="ticket-form-label" for="ticketComment">Comment</label><textarea id="ticketComment" name="comment" rows="5" class="form-control ticket-control" required placeholder="Write an update about this complaint…">{{ old('comment') }}</textarea>
                <input type="hidden" name="customer_visible" value="0"><div class="form-check mt-3"><input class="form-check-input" type="checkbox" name="customer_visible" value="1" id="customerVisible" checked><label class="form-check-label text-sm" for="customerVisible">Email this update to the customer</label></div>
                <button class="btn bg-gradient-dark float-end mt-3 mb-0">Save update</button>
            </form>
        </div></div>
    </div>
</div>
@endsection
