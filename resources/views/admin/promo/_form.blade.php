@php
    $isEdit = isset($promo);
    $backgroundColor = old('background_color', $isEdit ? ($promo->bgcolor ?: '#f26522') : '#f26522');
    $textColor = old('text_color', $isEdit ? ($promo->text_color ?: '#ffffff') : '#ffffff');
    $accentColor = old('accent_color', $isEdit ? ($promo->accent_color ?: '#111827') : '#111827');
    $title = old('title', $isEdit ? ($promo->title ?: 'NEW CUSTOMER OFFER') : 'NEW CUSTOMER OFFER');
    $message = old('message', $isEdit ? ($promo->message ?: 'Create an account today and get {discount}% OFF your next order. Your personal coupon code will be sent to your email after registration.') : 'Create an account today and get {discount}% OFF your next order. Your personal coupon code will be sent to your email after registration.');
    $ctaText = old('cta_text', $isEdit ? ($promo->cta_text ?: 'CREATE ACCOUNT') : 'CREATE ACCOUNT');
    $ctaUrl = old('cta_url', $isEdit ? ($promo->cta_url ?: '/register') : '/register');
    $couponPercent = old('coupon_percent', $isEdit ? ($promo->coupon_percent ?: 5) : 5);
    $isActive = old('is_active', $isEdit ? (bool) $promo->is_active : true);
@endphp

<div class="row">
    <div class="col-lg-8">
        <div class="card mt-4">
            <div class="card-header pb-0">
                <h5 class="mb-1">Homepage welcome offer</h5>
                <p class="text-sm text-secondary mb-0">Controls the new-customer coupon strip on the homepage and the welcome coupon percentage generated at registration.</p>
            </div>
            <div class="card-body pt-3">
                @include('errors.errors')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Headline</label>
                        <input type="text" class="form-control" name="title" value="{{ $title }}" required maxlength="120">
                        <small class="text-secondary">Use <code>{discount}</code> anywhere you want the current percentage inserted automatically.</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Welcome discount (%)</label>
                        <input type="number" class="form-control" name="coupon_percent" value="{{ $couponPercent }}" min="1" max="100" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Promo message</label>
                        <textarea class="form-control" name="message" rows="3" required maxlength="500">{{ $message }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Background color</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" class="form-control form-control-color" value="{{ $backgroundColor }}" oninput="this.nextElementSibling.value=this.value">
                            <input type="text" class="form-control" name="background_color" value="{{ $backgroundColor }}" pattern="#[0-9A-Fa-f]{6}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Text color</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" class="form-control form-control-color" value="{{ $textColor }}" oninput="this.nextElementSibling.value=this.value">
                            <input type="text" class="form-control" name="text_color" value="{{ $textColor }}" pattern="#[0-9A-Fa-f]{6}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Button color</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" class="form-control form-control-color" value="{{ $accentColor }}" oninput="this.nextElementSibling.value=this.value">
                            <input type="text" class="form-control" name="accent_color" value="{{ $accentColor }}" pattern="#[0-9A-Fa-f]{6}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Button text</label>
                        <input type="text" class="form-control" name="cta_text" value="{{ $ctaText }}" maxlength="60">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Button link</label>
                        <input type="text" class="form-control" name="cta_url" value="{{ $ctaUrl }}" maxlength="255">
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" name="is_active" value="1" type="checkbox" id="is_active" {{ $isActive ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Show this offer on the homepage</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mt-4">
            <div class="card-header pb-0">
                <h6 class="mb-0">How it works</h6>
            </div>
            <div class="card-body pt-3">
                <ul class="text-sm ps-3 mb-0">
                    <li class="mb-2">Homepage visitors see the active offer as a prominent promo strip.</li>
                    <li class="mb-2">The same percentage is used when generating a new customer’s personal voucher.</li>
                    <li class="mb-2">The registration page tells the customer their coupon will arrive by email.</li>
                    <li>The welcome email displays the actual personal coupon code created for that account.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 text-end">
    <a href="{{ route('promos.index') }}" class="btn btn-outline-secondary btn-sm mb-0 me-2">Cancel</a>
    <button type="submit" class="btn bg-gradient-dark btn-sm mb-0">Save welcome offer</button>
</div>
