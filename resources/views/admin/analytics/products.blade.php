@extends('admin.layouts.app')
@section('content')
@include('admin.analytics._header', ['title' => 'Product analytics', 'description' => 'Best sellers, product revenue and inventory risks.'])
<div class="row">
    <div class="col-lg-8 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Top-selling products</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Product</th><th class="text-end">Units</th><th class="text-end">Sales</th></tr></thead><tbody>
        @forelse($topProducts as $product)<tr><td class="px-4"><span class="text-sm font-weight-bold">{{ $product->name }}</span></td><td class="text-end">{{ number_format($product->units) }}</td><td class="text-end px-4">₦{{ number_format($product->sales, 2) }}</td></tr>@empty<tr><td colspan="3" class="text-center text-secondary py-4">No product sales in this period.</td></tr>@endforelse
    </tbody></table></div></div></div></div>
    <div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Low-stock products</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Product</th><th class="text-end">Stock</th></tr></thead><tbody>
        @forelse($lowStock as $product)<tr><td class="px-4"><a href="{{ route('products.edit', $product->id) }}" class="text-sm font-weight-bold">{{ $product->name }}</a><div class="text-xs text-secondary">{{ $product->sku ?: 'No SKU' }}</div></td><td class="text-end px-4"><span class="badge bg-gradient-{{ $product->quantity <= 0 ? 'danger' : 'warning' }}">{{ number_format($product->quantity) }}</span></td></tr>@empty<tr><td colspan="2" class="text-center text-secondary py-4">No low-stock products.</td></tr>@endforelse
    </tbody></table></div></div></div></div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Fast-moving products</h6><p class="text-xs text-secondary">More than 5 units sold this month</p></div><div class="card-body px-0"><table class="table mb-0"><tbody>@forelse($fastProducts as $product)<tr><td class="px-4 text-sm">{{ $product->name }}</td><td class="text-end px-4">{{ number_format($product->units) }} units</td></tr>@empty<tr><td class="text-center py-4">No fast-moving products.</td></tr>@endforelse</tbody></table></div></div></div>
    <div class="col-lg-6 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Slow-moving products</h6><p class="text-xs text-secondary">No sale in the last 60 days</p></div><div class="card-body px-0"><table class="table mb-0"><tbody>@forelse($slowProducts as $product)<tr><td class="px-4"><span class="text-sm">{{ $product->name }}</span><div class="text-xs text-secondary">{{ $product->sku ?: 'No SKU' }}</div></td></tr>@empty<tr><td class="text-center py-4">No slow-moving products.</td></tr>@endforelse</tbody></table></div></div></div>
</div>
@endsection
