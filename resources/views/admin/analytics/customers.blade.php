@extends('admin.layouts.app')
@section('content')
@include('admin.analytics._header', ['title' => 'Customer analytics', 'description' => 'Customer acquisition, growth and buying performance.'])
@include('admin.analytics._chart', ['chartTitle' => 'New customers — selected period'])
<div class="card mb-4"><div class="card-header pb-0"><h6>Top buying customers in selected period</h6></div><div class="card-body px-0 pb-2"><div class="table-responsive"><table class="table align-items-center mb-0"><thead><tr><th>Customer</th><th class="text-end">Orders</th><th class="text-end">Spend</th></tr></thead><tbody>
@forelse($topCustomers as $customer)<tr><td class="px-4 text-sm font-weight-bold">{{ $customer->customer }}</td><td class="text-end">{{ number_format($customer->orders) }}</td><td class="text-end px-4">₦{{ number_format((float) $customer->spent, 2) }}</td></tr>@empty<tr><td colspan="3" class="text-center text-secondary py-4">No customer orders found.</td></tr>@endforelse
</tbody></table></div></div></div>
@endsection
