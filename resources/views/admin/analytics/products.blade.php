@extends('admin.layouts.app')
@section('content')
<style>
    .analytics-product-list {
        width: 100%;
        table-layout: fixed;
    }

    .analytics-product-list td {
        white-space: normal !important;
        vertical-align: top;
    }

    .analytics-product-name {
        display: block;
        max-width: 100%;
        white-space: normal !important;
        overflow-wrap: anywhere;
        word-break: break-word;
        line-height: 1.35;
    }

    .analytics-product-sku {
        display: block;
        margin-top: 0.25rem;
        white-space: normal !important;
        overflow-wrap: anywhere;
    }
</style>
@include('admin.analytics._header', ['title' => 'Product analytics', 'description' => 'Top sellers, product revenue, stock risks and products that need attention.'])
<div class="card mb-4"><div class="card-header pb-0"><h6>Top-selling products</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Product</th><th class="text-end">Units</th><th class="text-end">Sales</th></tr></thead><tbody>
@forelse($topProducts as $product)<tr><td class="px-4 text-sm font-weight-bold">{{ $product->name }}</td><td class="text-end">{{ number_format($product->units) }}</td><td class="text-end px-4">₦{{ number_format((float) $product->sales, 2) }}</td></tr>@empty<tr><td colspan="3" class="text-center text-secondary py-4">No product sales found in this period.</td></tr>@endforelse
</tbody></table></div></div></div>
<div class="row">
   <div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Fast-moving products</h6><p class="text-xs text-secondary">More than five units sold</p></div><div class="card-body px-0"><table class="table mb-0 analytics-product-list"><tbody>@forelse($fastProducts as $product)<tr><td class="px-4 text-sm"><span class="analytics-product-name">{{ $product->name }}</span></td><td class="text-end px-4 font-weight-bold">{{ number_format($product->units) }}</td></tr>@empty<tr><td class="text-center py-4">No fast-moving products.</td></tr>@endforelse</tbody></table></div></div></div>
   <div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Low-stock products</h6><p class="text-xs text-secondary">Five units or fewer</p></div><div class="card-body px-0"><table class="table mb-0 analytics-product-list"><tbody>@forelse($lowStock as $product)<tr><td class="px-4"><a href="{{ route('products.edit', $product->id) }}" class="text-sm font-weight-bold analytics-product-name">{{ $product->name }}</a><div class="text-xs text-secondary analytics-product-sku">{{ $product->sku ?: 'No SKU' }}</div></td><td class="text-end px-4">{{ number_format($product->quantity) }}</td></tr>@empty<tr><td class="text-center py-4">No low-stock products.</td></tr>@endforelse</tbody></table></div></div></div>
   <div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Products not sold in selected period</h6><p class="text-xs text-secondary">No non-cancelled order contains these products in the selected period</p></div><div class="card-body px-0"><table class="table mb-0 analytics-product-list"><tbody>@forelse($slowProducts as $product)<tr><td class="px-4"><a href="{{ route('products.edit', $product->id) }}" class="text-sm font-weight-bold analytics-product-name">{{ $product->name }}</a><div class="text-xs text-secondary analytics-product-sku">{{ $product->sku ?: 'No SKU' }}</div></td></tr>@empty<tr><td class="text-center py-4">Every eligible product has sold.</td></tr>@endforelse</tbody></table></div></div></div>
</div>
@endsection
