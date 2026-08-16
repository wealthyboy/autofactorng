@extends('admin.layouts.app')
@section('content')
@include('admin.analytics._header', ['title' => 'Analytics overview', 'description' => 'A consolidated view of store performance.'])
@include('admin.analytics._trend')
<div class="row">
    <div class="col-lg-7 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Recent orders</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Invoice</th><th>Customer</th><th>Status</th><th class="text-end">Total</th></tr></thead><tbody>
        @forelse($recentOrders as $order)<tr><td class="px-4"><a href="{{ route('admin.orders.show', $order->id) }}" class="text-sm font-weight-bold">{{ $order->invoice ?: '#' . $order->id }}</a><div class="text-xs text-secondary">{{ optional($order->created_at)->format('d M Y') }}</div></td><td><span class="text-sm">{{ trim($order->first_name . ' ' . $order->last_name) ?: ($order->email ?: 'Guest') }}</span></td><td><span class="badge bg-gradient-{{ $order->status === 'Cancelled' ? 'danger' : ($order->status === 'Delivered' ? 'success' : 'info') }}">{{ $order->status ?: 'Unknown' }}</span></td><td class="text-end px-4">₦{{ number_format((float) $order->total, 2) }}</td></tr>@empty<tr><td colspan="4" class="text-center text-secondary py-4">No orders in this period.</td></tr>@endforelse
    </tbody></table></div></div></div></div>
    <div class="col-lg-5 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Top products by sales</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Product</th><th class="text-end">Units</th><th class="text-end">Sales</th></tr></thead><tbody>
        @forelse($topProducts as $product)<tr><td class="px-4"><span class="text-sm font-weight-bold">{{ $product->name }}</span></td><td class="text-end">{{ number_format($product->units) }}</td><td class="text-end px-4">₦{{ number_format($product->sales, 2) }}</td></tr>@empty<tr><td colspan="3" class="text-center text-secondary py-4">No product sales in this period.</td></tr>@endforelse
    </tbody></table></div></div></div></div>
</div>
@endsection
