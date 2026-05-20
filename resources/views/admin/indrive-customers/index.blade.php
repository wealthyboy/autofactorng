@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
                    <i class="material-symbols-outlined">filter_alt</i>
                </div>
                <h6 class="mb-0">Filter inDrive Customers</h6>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('admin.indrive-customers.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">Search</label>
                                <input name="q" type="text" value="{{ $filters['q'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">From</label>
                                <input name="from" type="date" value="{{ $filters['from'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">To</label>
                                <input name="to" type="date" value="{{ $filters['to'] ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <div class="input-group input-group-outline is-filled">
                                <label class="form-label">Orders</label>
                                <select name="has_orders" class="form-control">
                                    <option value="">All</option>
                                    <option value="yes" {{ ($filters['has_orders'] ?? '') === 'yes' ? 'selected' : '' }}>Has orders</option>
                                    <option value="no" {{ ($filters['has_orders'] ?? '') === 'no' ? 'selected' : '' }}>No orders</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
                    <a href="{{ route('admin.indrive-customers.index') }}" class="btn btn-outline-secondary btn-sm float-end mt-2 mb-0 me-2">Reset</a>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ps-3">
                <div>
                    <h4 class="m-0">inDrive Customers</h4>
                    <p class="text-sm mb-0">{{ $customers->total() }} customers found</p>
                </div>
                <a href="{{ route('admin.indrive-customers.export', request()->query()) }}" class="btn btn-outline-primary btn-sm mb-0">Export</a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush align-items-center mb-0">
                    <thead>
                        <tr>
                            <th><h6 class="mb-0 text-xs">ID</h6></th>
                            <th><h6 class="mb-0 text-xs">Name</h6></th>
                            <th><h6 class="mb-0 text-xs">Email</h6></th>
                            <th><h6 class="mb-0 text-xs">Phone</h6></th>
                            <th><h6 class="mb-0 text-xs">Orders</h6></th>
                            <th><h6 class="mb-0 text-xs">Source</h6></th>
                            <th><h6 class="mb-0 text-xs">Joined</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td><h6 class="mb-0 text-xs">{{ $customer->id }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $customer->fullname() }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $customer->email }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $customer->phone_number }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $customer->orders_count }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ $customer->acquisition_source ?: 'indrive' }}</h6></td>
                                <td><h6 class="mb-0 text-xs">{{ optional($customer->created_at)->format('d-m-y') }}</h6></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <h6 class="mb-0 text-xs">No inDrive customers found.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
