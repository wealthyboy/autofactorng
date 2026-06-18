@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-content p-4 mb-4">
                        <h4 class="card-title">Filter Stock Snapshots</h4>

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Batch ID</label>
                                        <input type="text" class="form-control" name="batch_id" value="{{ request('batch_id') }}" placeholder="linode-backup-20260618">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Source</label>
                                        <input type="text" class="form-control" name="source" value="{{ request('source') }}" placeholder="linode-backup">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product ID</label>
                                        <input type="number" class="form-control" name="product_id" value="{{ request('product_id') }}" placeholder="Product ID">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ request('name') }}" placeholder="Search product name">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" name="from_date" value="{{ request('from_date') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" name="to_date" value="{{ request('to_date') }}">
                                    </div>
                                </div>

                                <div class="col-md-3 mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Apply Filter
                                    </button>
                                </div>

                                <div class="col-md-3 mt-4">
                                    <a href="/admin/stock-snapshots" class="btn btn-outline-secondary btn-block">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-header text-white">
                <h4 class="mb-0">Stock Snapshots</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Date</th>
                            <th>Batch ID</th>
                            <th>Source</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($snapshots as $snapshot)
                        <tr>
                            <td>{{ optional($snapshot->created_at)->format('Y-m-d H:i') }}</td>
                            <td>{{ $snapshot->batch_id }}</td>
                            <td>{{ $snapshot->source ?: '-' }}</td>
                            <td>{{ $snapshot->product_id }}</td>
                            <td>{{ $snapshot->name ?: $snapshot->product_name }}</td>
                            <td>{{ number_format($snapshot->quantity) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No stock snapshots found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $snapshots->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
