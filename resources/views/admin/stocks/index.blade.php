@extends('admin.layouts.app')

@section('content')
<div class="row">


    <div class="col-12">


        <div class="card shadow-sm">
            {{-- ✅ Filter Card --}}
            <div class="col-md-12">
                <div class="card">

                    <!-- Header Icon -->


                    <div class="card-content p-4 mb-4">
                        <h4 class="card-title">Filter </h4>

                        <form action="" method="GET">

                            <!-- FILTER FIELDS -->
                            <div class="row">

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




                            </div>



                            <hr>




                        </form>
                    </div>
                </div>
            </div>
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