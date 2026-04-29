@extends('layouts.auth')

@section('content')
<style>
    .is-invalid {
        border-color: #dc3545 !important;
        background-color: #fff5f5;
    }

    .is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    #survey-validation-error {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
</style>
<div class="container-fluid px-0">
    <div class="row justify-content-center align-items-start">
        <div class="col-xl-6 col-lg-7 col-md-10 col-12">
            <div class="content p-5">


                <div class="logo mb-4 text-center">
                    <a class="px-5" href="/">
                        <img src="/images/logo/autofactor_logo.png" alt="Autofactor" style="max-height: 60px;">
                    </a>
                </div>

                <div class="mb-4">
                    <h1 class="mb-2">Customer Satisfaction Survey</h1>
                    <p>Please take 1 minute to rate your experience. Thank you for shopping with us!</p>
                    <p class="text-muted small"><span class="text-danger">*</span> All fields are required</p>
                </div>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="customer-survey-form" method="POST" action="{{ route('customer-survey.submit') }}">
                    @csrf

                    <div id="survey-validation-error" class="alert alert-danger d-none"></div>

                    <div class="mb-3">
                        <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="you@example.com" required>
                    </div>

                    <h5 class="mt-4">Section 1: Customer Service Experience <span class="text-danger">*</span></h5>

                    <div class="mb-3">
                        <label class="form-label">1. How satisfied are you with our customer support during your order processing?</label>
                        @foreach (['Very Satisfied','Satisfied','Neutral','Dissatisfied','Very Dissatisfied'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="service_satisfaction" id="service_satisfaction_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('service_satisfaction') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label  cursor-pointer" for="service_satisfaction_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">2. Was your enquiry or concern resolved promptly?</label>
                        @foreach (['Yes, completely','Partially','Not resolved'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="resolved_promptly" id="resolved_promptly_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('resolved_promptly') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label  cursor-pointer" for="resolved_promptly_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">3. How would you rate our response time?</label>
                        @foreach (['Excellent','Good','Fair','Poor'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="response_time" id="response_time_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('response_time') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="response_time_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">4. Our support staff was:</label>
                        @foreach (['Professional','Helpful','Courteous','Knowledgeable','Needs Improvement'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="support_staff" id="support_staff_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('support_staff') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="support_staff_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <h5 class="mt-4">Section 2: Order & Delivery Experience <span class="text-danger">*</span></h5>

                    <div class="mb-3">
                        <label class="form-label">1. How satisfied are you with your order delivery experience?</label>
                        @foreach (['Very Satisfied','Satisfied','Neutral','Dissatisfied','Very Dissatisfied'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivery_satisfaction" id="delivery_satisfaction_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('delivery_satisfaction') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="delivery_satisfaction_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">2. Was your order delivered within the expected timeframe?</label>
                        @foreach (['Yes','No'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delivered_on_time" id="delivered_on_time_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('delivered_on_time') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="delivered_on_time_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">3. Condition of the delivered item:</label>
                        @foreach (['Excellent','Good','Fair','Damaged'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="condition" id="condition_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('condition') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="condition_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">3. Was the product exactly as described on our website?</label>
                        @foreach (['Yes','No'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accurate_description" id="accurate_description_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('accurate_description') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="accurate_description_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <h5 class="mt-4">Section 3: Overall Experience <span class="text-danger">*</span></h5>

                    <div class="mb-3">
                        <label class="form-label">1. Overall, how satisfied are you with your purchase?</label>
                        @foreach (['Very Satisfied','Satisfied','Neutral','Dissatisfied','Very Dissatisfied'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="overall_satisfaction" id="overall_satisfaction_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('overall_satisfaction') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="overall_satisfaction_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">2. How likely are you to purchase from us again?</label>
                        @foreach (['Very Likely','Likely','Not Sure','Unlikely'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="likely_to_purchase_again" id="likely_to_purchase_again_{{ \Illuminate\Support\Str::slug($option) }}" value="{{ $option }}" {{ old('likely_to_purchase_again') === $option ? 'checked' : '' }} required>
                            <label class="form-check-label cursor-pointer" for="likely_to_purchase_again_{{ \Illuminate\Support\Str::slug($option) }}">{{ $option }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">3. What can we improve?</label>
                        <textarea name="improvement_suggestions" class="form-control" rows="4" placeholder="Share what we can do better">{{ old('improvement_suggestions') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="submit" id="customer-survey-submit" class="btn btn-primary">Submit Survey</button>
                        <a href="/" class="text-muted">Back to store</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@section('page-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('customer-survey-form');
                var errorBox = document.getElementById('survey-validation-error');
                var submitButton = document.getElementById('customer-survey-submit');

                form.addEventListener('submit', function(e) {
                    errorBox.classList.add('d-none');
                    var errors = [];

                    // Check customer name
                    if (form.customer_name.value.trim() === '') {
                        errors.push('✗ Customer name is required');
                        form.customer_name.classList.add('is-invalid');
                    } else {
                        form.customer_name.classList.remove('is-invalid');
                    }

                    // Check email
                    if (form.email.value.trim() === '') {
                        errors.push('✗ Email is required');
                        form.email.classList.add('is-invalid');
                    } else if (!form.email.value.includes('@')) {
                        errors.push('✗ Please enter a valid email address');
                        form.email.classList.add('is-invalid');
                    } else {
                        form.email.classList.remove('is-invalid');
                    }

                    // Check all required radio button groups
                    var requiredGroups = [{
                            name: 'service_satisfaction',
                            label: 'Service satisfaction'
                        },
                        {
                            name: 'resolved_promptly',
                            label: 'Resolved promptly'
                        },
                        {
                            name: 'response_time',
                            label: 'Response time'
                        },
                        {
                            name: 'support_staff',
                            label: 'Support staff rating'
                        },
                        {
                            name: 'delivery_satisfaction',
                            label: 'Delivery satisfaction'
                        },
                        {
                            name: 'delivered_on_time',
                            label: 'Delivered on time'
                        },
                        {
                            name: 'condition',
                            label: 'Condition of item'
                        },
                        {
                            name: 'accurate_description',
                            label: 'Accurate description'
                        },
                        {
                            name: 'overall_satisfaction',
                            label: 'Overall satisfaction'
                        },
                        {
                            name: 'likely_to_purchase_again',
                            label: 'Likelihood to purchase again'
                        }
                    ];

                    requiredGroups.forEach(function(group) {
                        var isChecked = form.querySelector('input[name="' + group.name + '"]:checked') !== null;
                        if (!isChecked) {
                            errors.push('✗ ' + group.label + ' - Please select an option');
                        }
                    });

                    if (errors.length > 0) {
                        e.preventDefault();
                        errorBox.innerHTML = '<strong style="font-size: 1.1em;">⚠️ Please fix the following errors:</strong><ul class="mb-0 mt-2" style="line-height: 1.8;">' +
                            errors.map(err => '<li>' + err + '</li>').join('') + '</ul>';
                        errorBox.classList.remove('d-none');
                        errorBox.style.borderLeft = '4px solid #dc3545';
                        errorBox.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        return;
                    }

                    submitButton.disabled = true;
                    submitButton.innerText = 'Submitting...';
                });

                // Remove error styling when user starts typing
                form.customer_name.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
                form.email.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
            });
</script>
@endsection
