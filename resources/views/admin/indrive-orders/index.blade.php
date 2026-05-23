@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>
                </div>
                <h6 class="mb-0">Filter In Drive Analytics</h6>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('admin.indrive-orders.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-3 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">Driver / ID / Email / Phone</label>
                                <input name="q" type="text" value="{{ $filters['q'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">From</label>
                                <input name="from" type="date" value="{{ $filters['from'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">To</label>
                                <input name="to" type="date" value="{{ $filters['to'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">Fulfillment</label>
                                <select name="fulfillment" class="form-control">
                                    <option value="">All</option>
                                    <option value="delivery" {{ ($filters['fulfillment'] ?? '') === 'delivery' ? 'selected' : '' }}>Delivery</option>
                                    <option value="pickup" {{ ($filters['fulfillment'] ?? '') === 'pickup' ? 'selected' : '' }}>Pickup</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All</option>
                                    @foreach(['Confirmed', 'Processing', 'Shipped', 'Delivered', 'Refunded', 'Returned', 'Cancelled'] as $status)
                                        <option value="{{ $status }}" {{ ($filters['status'] ?? '') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
                    <a href="{{ route('admin.indrive-orders.index') }}" class="btn btn-outline-secondary btn-sm float-end mt-2 mb-0 me-2">Reset</a>
                </form>
            </div>
        </div>

        <div class="row mb-3">
            @foreach([
                'Drivers' => $stats['drivers'],
                'Orders' => $stats['orders'],
                'Order Value' => $stats['order_value'],
                'Pickups' => $stats['pickup_orders'],
                'Deliveries' => $stats['delivery_orders'],
                'Top Driver' => $stats['top_driver'],
                'Top Item' => $stats['top_item'],
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

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ps-3">
                <div>
                    <h4 class="m-0">In Drive Analytics</h4>
                    <p class="text-sm mb-0">{{ $drivers->total() }} drivers found</p>
                </div>
                <a href="{{ route('admin.indrive-orders.export', request()->query()) }}" class="btn btn-outline-primary btn-sm mb-0">Export</a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush align-items-center mb-0">
                    <thead>
                        <tr>
                            <th><h6 class="mb-0 text-xs">Name</h6></th>
                            <th><h6 class="mb-0 text-xs">Driver ID</h6></th>
                            <th><h6 class="mb-0 text-xs">Clicks</h6></th>
                            <th><h6 class="mb-0 text-xs">Website Visits</h6></th>
                            <th><h6 class="mb-0 text-xs">Location</h6></th>
                            <th><h6 class="mb-0 text-xs">Delivery / Pickup</h6></th>
                            <th><h6 class="mb-0 text-xs">Order Count</h6></th>
                            <th><h6 class="mb-0 text-xs">Order Value</h6></th>
                            <th><h6 class="mb-0 text-xs">Top Item</h6></th>
                            <th><h6 class="mb-0 text-xs">Returned Items</h6></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drivers as $row)
                            <tr>
                                <td>
                                    <h6 class="mb-0 text-xs">{{ $row['driver']->fullname() }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $row['driver']->email }}</p>
                                </td>
                                <td><h6 class="mb-0 text-xs">{{ $row['driver']->indrive_driver_id ?: '---' }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['clicks'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['website_visits'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['location'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['delivery_orders'] }} / {{ $row['pickup_orders'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['order_count'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['order_value'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['top_purchased_item'] }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $row['returned_items'] }}</h6></td>
                                <td>
                                    <a href="{{ route('admin.indrive-orders.show', array_merge(['user' => $row['driver']->id], request()->query())) }}" data-bs-toggle="tooltip" data-bs-original-title="View">
                                        <i class="material-symbols-outlined text-secondary position-relative text-lg">preview</i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-4">
                                    <h6 class="mb-0 text-xs">No inDrive order data found.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $drivers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
