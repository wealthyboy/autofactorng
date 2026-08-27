@extends('admin.layouts.app')
@section('content')
@include('admin.analytics._header', ['title' => 'Order analytics', 'description' => 'Revenue, order volume, customer behaviour and sales channels.'])
@include('admin.analytics._trend')
<div class="row">
   <div class="col-lg-6 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Order status</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Status</th><th class="text-end">Orders</th></tr></thead><tbody>
   @forelse($statuses as $status)<tr><td class="px-4"><span class="text-sm font-weight-bold">{{ $status->status ?: 'Not specified' }}</span></td><td class="text-end px-4">{{ number_format($status->total) }}</td></tr>@empty<tr><td colspan="2" class="text-center text-secondary py-4">No orders found in this period.</td></tr>@endforelse
   </tbody></table></div></div></div></div>
   <div class="col-lg-6 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Sales channels</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Channel</th><th class="text-end">Orders</th></tr></thead><tbody>
   @forelse($channels as $channel)<tr><td class="px-4"><span class="text-sm font-weight-bold">{{ $channel->label }}</span></td><td class="text-end px-4">{{ number_format($channel->total) }}</td></tr>@empty<tr><td colspan="2" class="text-center text-secondary py-4">No channel data found.</td></tr>@endforelse
   </tbody></table></div></div></div></div>
</div>
@endsection
