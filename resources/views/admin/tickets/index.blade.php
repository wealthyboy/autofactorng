@extends('admin.layouts.app')

@section('page-styles')
@include('admin.tickets._styles')
@endsection

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div><h4 class="mb-1">Customer tickets</h4><p class="text-sm text-secondary mb-0">Complaints, returned items and order-related issues.</p></div>
    <a href="{{ route('admin.tickets.create') }}" class="btn bg-gradient-dark mb-0"><i class="material-symbols-outlined text-sm me-1">add</i> New ticket</a>
</div>

@if(session('success'))<div class="alert alert-success text-white">{{ session('success') }}</div>@endif

<div class="card ticket-form-card mb-4"><div class="card-body p-3">
    <form method="get" class="row g-2 align-items-end">
        <div class="col-md-6"><label class="ticket-form-label">Search ticket, order ID or invoice</label><input name="q" value="{{ request('q') }}" class="form-control ticket-control" placeholder="TKT-..., order ID or invoice"></div>
        <div class="col-md-3"><label class="ticket-form-label">Status</label><select name="status" class="form-control ticket-control"><option value="">All statuses</option>@foreach(\App\Models\Ticket::STATUSES as $status)<option value="{{ $status }}" @if(request('status') === $status) selected @endif>{{ $status }}</option>@endforeach</select></div>
        <div class="col-md-3"><button class="btn bg-gradient-dark mb-0">Filter</button> <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary mb-0">Reset</a></div>
    </form>
</div></div>

<div class="card"><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0">
    <thead><tr><th>Ticket</th><th>Order</th><th>Customer</th><th>Department</th><th>Reason</th><th>Category</th><th>Return Total</th><th>Approval</th><th>Status</th><th>Created</th><th></th></tr></thead>
    <tbody>@forelse($tickets as $ticket)
        <tr>
            <td class="px-4"><a class="text-sm font-weight-bold" href="{{ route('admin.tickets.show', $ticket) }}">{{ $ticket->ticket_number }}</a></td>
            <td><a class="text-sm" href="{{ route('admin.orders.show', $ticket->order_id) }}">{{ optional($ticket->order)->invoice ?: '#' . $ticket->order_id }}</a></td>
            <td><span class="text-sm font-weight-bold">{{ $ticket->order ? (trim($ticket->order->fullName()) ?: optional($ticket->order->user)->fullname() ?: '—') : '—' }}</span></td>
            <td><span class="text-sm">{{ $ticket->department ?: '—' }}</span></td>
            <td><span class="text-sm">{{ $ticket->reason }}</span></td>
            <td><span class="text-sm">{{ $ticket->category ?: '—' }}</span></td>
            <td><span class="text-sm">₦{{ number_format((float) $ticket->return_total, 2) }}</span></td>
            <td>
                @if(! $ticket->requiresPaymentApproval())
                    <span class="badge bg-gradient-secondary">Not required</span>
                @elseif($ticket->paymentApprovalStatus() === 'Approved')
                    <span class="badge bg-gradient-success">Approved</span>
                    @if($ticket->approved_at)
                        <span class="d-block text-xs text-secondary mt-1">{{ $ticket->approved_at->format('d M Y') }}</span>
                    @endif
                @elseif($ticket->paymentApprovalStatus() === 'Not Approved')
                    <span class="badge bg-gradient-danger">Not Approved</span>
                @else
                    <span class="badge bg-gradient-warning">Pending</span>
                @endif
            </td>
            <td><span class="badge bg-gradient-{{ in_array($ticket->status, ['Resolved', 'Closed']) ? 'success' : ($ticket->status === 'In Progress' ? 'info' : 'warning') }}">{{ $ticket->status }}</span></td>
            <td><span class="text-sm">{{ optional($ticket->created_at)->format('d M Y') }}</span></td>
            <td class="text-end px-4"><a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-dark mb-0">View</a></td>
        </tr>
    @empty<tr><td colspan="11" class="text-center text-secondary py-5">No tickets found.</td></tr>@endforelse</tbody>
</table></div><div class="px-4 pt-3">{{ $tickets->links() }}</div></div></div>
@endsection
