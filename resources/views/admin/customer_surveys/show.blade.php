@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6>Survey Submission #{{ $survey->id }}</h6>
                    <a href="{{ route('admin.customer-surveys.index') }}" class="btn btn-sm btn-secondary">Back to list</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Customer</h6>
                            <p><strong>Name:</strong> {{ $survey->customer_name ?? '—' }}</p>
                            <p><strong>Email:</strong> {{ $survey->email ?? '—' }}</p>
                            <p><strong>Submitted:</strong> {{ $survey->created_at?->format('Y-m-d H:i') ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Overall</h6>
                            <p><strong>Overall satisfaction:</strong> {{ $survey->overall_satisfaction ?? '—' }}</p>
                            <p><strong>Likely to purchase again:</strong> {{ $survey->likely_to_purchase_again ?? '—' }}</p>
                        </div>
                    </div>

                    <hr>

                    <h6>Customer Service Experience</h6>
                    <ul>
                        <li><strong>Service satisfaction:</strong> {{ $survey->service_satisfaction ?? '—' }}</li>
                        <li><strong>Resolved promptly:</strong> {{ $survey->resolved_promptly ?? '—' }}</li>
                        <li><strong>Response time:</strong> {{ $survey->response_time ?? '—' }}</li>
                        <li><strong>Support staff:</strong> {{ is_array($survey->support_staff) ? implode(', ', $survey->support_staff) : ($survey->support_staff ?? '—') }}</li>
                    </ul>

                    <h6>Order & Delivery Experience</h6>
                    <ul>
                        <li><strong>Delivery satisfaction:</strong> {{ $survey->delivery_satisfaction ?? '—' }}</li>
                        <li><strong>Delivered on time:</strong> {{ $survey->delivered_on_time ?? '—' }}</li>
                        <li><strong>Condition:</strong> {{ $survey->condition ?? '—' }}</li>
                        <li><strong>Accurate description:</strong> {{ $survey->accurate_description ?? '—' }}</li>
                    </ul>

                    <h6>Improvement Suggestions</h6>
                    <p>{{ $survey->improvement_suggestions ?: 'No additional notes.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection