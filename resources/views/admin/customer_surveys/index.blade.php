@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Customer Satisfaction Survey </h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">#</th>
                                    <th style="color: #000 !important;" class="text-uppercase text-secondary text-xxs font-weight-bolder "><b>Customer</b></th>
                                    <th style="color: #000 !important;" class="text-uppercase text-secondary text-xxs font-weight-bolder ">Email</th>
                                    <th style="color: #000 !important;" class="text-uppercase text-secondary text-xxs font-weight-bolder ">Submitted</th>
                                    <th style="color: #000 !important;" class="text-uppercase text-secondary text-xxs font-weight-bolder ">Overall</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($surveys as $survey)
                                <tr>
                                    <td></td>
                                    <td>{{ $survey->customer_name ?? '—' }}</td>
                                    <td>{{ $survey->email ?? '—' }}</td>
                                    <td>{{ $survey->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                    <td>{{ $survey->overall_satisfaction ?? '—' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.customer-surveys.show', $survey) }}" class="btn">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No survey submissions yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end px-3">
                            {{ $surveys->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection