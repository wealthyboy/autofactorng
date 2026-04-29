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
                        @if (session('status'))
                        <div class="alert alert-success mx-3">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger mx-3">
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <form action="{{ route('admin.customer-surveys.destroy-selected') }}" method="post" id="form-customer-surveys">
                            @csrf
                            @method('DELETE')

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-check mb-0">
                                    <input class="form-check-input" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox">
                                    <span class="form-check-label">Select All</span>
                                </label>

                                <button type="button" onclick="confirm('Are you sure you want to delete the selected survey submissions?') ? $('#form-customer-surveys').submit() : false;" class="btn btn-outline-primary btn-sm mb-0">
                                    Delete Selected
                                </button>
                            </div>

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
                                        <td>
                                            <input class="form-check-input" value="{{ $survey->id }}" name="selected[]" type="checkbox">
                                        </td>
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
                        </form>

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
