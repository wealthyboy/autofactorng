@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex align-items-start justify-content-between">
                    <div>
                        <h5 class="mb-1">Homepage Welcome Offers</h5>
                        <p class="text-sm text-secondary mb-0">Manage the new-customer coupon message, colors and discount percentage shown on the storefront.</p>
                    </div>
                    <div class="mt-3 mt-lg-0">
                        <a href="{{ route('promos.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+ Add Offer</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($promos->isEmpty())
                    <div class="text-center py-5 text-secondary">No homepage offers yet.</div>
                @else
                    <div class="row g-4">
                        @foreach($promos as $promo)
                            <div class="col-12">
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                                        <div class="flex-grow-1">
                                            <div class="rounded-2 px-3 py-3" style="background:{{ $promo->bgcolor ?: '#f26522' }};color:{{ $promo->text_color ?: '#ffffff' }};">
                                                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                                                    <div>
                                                        <strong class="d-block">{{ $promo->displayTitle() }}</strong>
                                                        <span class="text-sm">{{ $promo->displayMessage() }}</span>
                                                    </div>
                                                    <span class="badge" style="background:{{ $promo->accent_color ?: '#111827' }};color:#fff;">{{ $promo->cta_text ?: 'CREATE ACCOUNT' }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-3 mt-2 text-xs text-secondary">
                                                <span>Discount: <strong>{{ $promo->coupon_percent ?: 5 }}%</strong></span>
                                                <span>Status: <strong>{{ $promo->is_active ? 'Active' : 'Disabled' }}</strong></span>
                                                <span>Link: <strong>{{ $promo->cta_url ?: '/register' }}</strong></span>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <a href="{{ route('promos.edit', ['promo' => $promo->id]) }}" class="btn btn-outline-primary btn-sm mb-0">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('inline-scripts')
@stop
