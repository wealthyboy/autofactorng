@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center ps-3">
                <div>
                    <h4 class="m-0">{{ $driver->fullname() }}</h4>
                    <p class="text-sm mb-0">{{ $driver->email }} {{ $driver->phone_number ? ' • '.$driver->phone_number : '' }}</p>
                </div>
                <a href="{{ route('admin.indrive-orders.index', request()->query()) }}" class="btn btn-outline-secondary btn-sm mb-0">Back</a>
            </div>
        </div>

        <div class="row mb-3">
            @foreach([
                'Clicks' => $row['clicks'],
                'Website Visits' => $row['website_visits'],
                'Order Count' => $row['order_count'],
                'Order Value' => $row['order_value'],
                'Delivery Orders' => $row['delivery_orders'],
                'Pickup Orders' => $row['pickup_orders'],
                'Top Item' => $row['top_purchased_item'],
                'Returned Items' => $row['returned_items'],
            ] as $label => $value)
                <div class="col-lg-3 col-md-4 col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-body p-3">
                            <p class="text-sm mb-1 text-capitalize">{{ $label }}</p>
                            <h5 class="mb-0">{{ $value }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card mb-3">
            <div class="card-header ps-3">
                <h5 class="m-0">Orders</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-flush align-items-center mb-0">
                    <thead>
                        <tr>
                            <th><h6 class="mb-0 text-xs">Invoice</h6></th>
                            <th><h6 class="mb-0 text-xs">Status</h6></th>
                            <th><h6 class="mb-0 text-xs">Fulfillment</h6></th>
                            <th><h6 class="mb-0 text-xs">Location</h6></th>
                            <th><h6 class="mb-0 text-xs">Total</h6></th>
                            <th><h6 class="mb-0 text-xs">Items</h6></th>
                            <th><h6 class="mb-0 text-xs">Date</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td><h6 class="mb-0 text-xs">{{ $order->invoice }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $order->status }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $order->zone === 'Pickup' ? 'Pickup' : 'Delivery' }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ collect([$order->city, $order->state, $order->zone])->filter()->implode(', ') ?: '---' }}</h6></td>
                                <td><h6 class="mb-0 text-xs">₦{{ number_format((float) $order->total) }}</h6></td>
                                <td>
                                    <h6 class="mb-0 text-xs">
                                        {{ $order->ordered_products->pluck('product_name')->filter()->take(3)->implode(', ') ?: '---' }}
                                    </h6>
                                </td>
                                <td><h6 class="mb-0 text-xs">{{ optional($order->created_at)->format('d-m-y') }}</h6></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <h6 class="mb-0 text-xs">No orders found.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $orders->links() }}
            </div>
        </div>

        <div class="card">
            <div class="card-header ps-3">
                <h5 class="m-0">Website Visits</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-flush align-items-center mb-0">
                    <thead>
                        <tr>
                            <th><h6 class="mb-0 text-xs">Page</h6></th>
                            <th><h6 class="mb-0 text-xs">Action</h6></th>
                            <th><h6 class="mb-0 text-xs">IP</h6></th>
                            <th><h6 class="mb-0 text-xs">Device</h6></th>
                            <th><h6 class="mb-0 text-xs">Referer</h6></th>
                            <th><h6 class="mb-0 text-xs">Visited</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visits as $visit)
                            <tr>
                                <td><h6 class="mb-0 text-xs text-truncate" style="max-width: 260px;">{{ $visit->page_url }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $visit->action }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $visit->ip_address }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $visit->device_type }}</h6></td>
                                <td><h6 class="mb-0 text-xs text-truncate" style="max-width: 220px;">{{ $visit->referer }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ optional($visit->visited_at)->format('d-m-y H:i') }}</h6></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <h6 class="mb-0 text-xs">No visits found.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $visits->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
