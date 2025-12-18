@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
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