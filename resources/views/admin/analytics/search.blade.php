@extends('admin.layouts.app')
@section('content')
@include('admin.analytics._header', ['title' => 'Search analytics', 'description' => 'Search demand and the products and categories visitors explore.'])
<div class="row">
<div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Most searched terms</h6></div><div class="card-body px-0"><table class="table mb-0"><tbody>@forelse($terms as $term => $count)<tr><td class="px-4 text-sm">{{ $term }}</td><td class="text-end px-4">{{ number_format($count) }}</td></tr>@empty<tr><td class="text-center py-4">No search terms recorded.</td></tr>@endforelse</tbody></table></div></div></div>
<div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Most viewed products</h6></div><div class="card-body px-0"><table class="table mb-0"><tbody>@forelse($products as $product)<tr><td class="px-4 text-sm">{{ $product->name }}</td><td class="text-end px-4">{{ number_format($product->views) }}</td></tr>@empty<tr><td class="text-center py-4">No product views recorded.</td></tr>@endforelse</tbody></table></div></div></div>
<div class="col-lg-4 mb-4"><div class="card h-100"><div class="card-header pb-0"><h6>Top categories explored</h6></div><div class="card-body px-0"><table class="table mb-0"><tbody>@forelse($categories as $category)<tr><td class="px-4 text-sm">{{ $category->name }}</td><td class="text-end px-4">{{ number_format($category->visits) }}</td></tr>@empty<tr><td class="text-center py-4">No category activity recorded.</td></tr>@endforelse</tbody></table></div></div></div>
</div>
@endsection
