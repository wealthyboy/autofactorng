@extends('admin.layouts.app')

@section('content')
<div class="row">


    <div class="col-12">
        <form method="GET" action="" class="mb-3">
            <div class="form-row">
                <div class="col-md-4">
                    <label>From Date</label>
                    <input type="date"
                        name="from_date"
                        class="form-control"
                        value="{{ request('from_date') }}">
                </div>

                <div class="col-md-4">
                    <label>To Date</label>
                    <input type="date"
                        name="to_date"
                        class="form-control"
                        value="{{ request('to_date') }}">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary mr-2" type="submit">
                        Filter
                    </button>

                    <a href=""
                        class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <div class="card shadow-sm">
            <div class="card-header text-white">
                <h4 class="mb-0">Stocks</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Action</th>
                            <th>User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $stock)
                        <tr>
                            <td>{{ $stock->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $stock->product_name }}</td>
                            <td>{{ $stock->action }}</td>
                            <td>{{ $stock->user_email }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No stock changes found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $stocks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="{{ asset('backend/products.js') }}"></script>
@stop

@section('inline-scripts')
@stop