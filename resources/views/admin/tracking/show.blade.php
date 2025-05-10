@extends('admin.layouts.app')
@section('content')

<div class="row">
    @foreach ($userTrackings as $data)
    <div class="card mb-3">


        <div class="card-header mb-0 d-flex  border-botoom">
            <h5 class="me-2 mb-0">Page URL:</h5>
            <span class="" style="max-width: 300px;" title="{{ $data->page_url }}">
                {{ $data->page_url }}
            </span>
        </div>

        <div class="card-body">
            <h5 class="card-title">{{ $data->action }}</h5>


            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>IP Address:</strong></h6>
                <span class="text-dark">{{ $data->ip_address }}</span>
            </div>

            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>Visited At:</strong></h6>
                <span class="text-dark"> {{ $data->visited_at }}</span>
            </div>

            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>User ID:</strong></h6>
                <span class="text-dark"> {{ $data->user_id ?? 'N/A' }}</span>
            </div>

            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>First Name:</strong></h6>
                <span class="text-dark"> {{ $data->first_name ?? 'N/A' }}</span>
            </div>

            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>Last Name:</strong></h6>
                <span class="text-dark"> {{ $data->last_name ?? 'N/A' }}</span>
            </div>

            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>Method:</strong></h6>
                <span class="text-dark"> {{ $data->method }}</span>
            </div>

            <div class="d-flex mb-1">
                <h6 class="me-2 mb-0"><strong>Referer:</strong></h6>
                <span class="ml-3 "> {{ $data->referer }}</span>
            </div>
        </div>


    </div>
    @endforeach

</div>
@endsection
@section('inline-scripts')
@stop