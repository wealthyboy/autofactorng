@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Abandoned Carts</h4>
        <p class="text-sm text-secondary mb-0">Unrecovered checkouts that became abandoned during the selected period.</p>
    </div>
    <a href="{{ route('admin.analytics.marketing', ['from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}" class="btn btn-outline-secondary mb-0">
        Marketing analytics
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger text-white">{{ $errors->first() }}</div>
@endif

<div class="card mb-4">
    <div class="card-body p-3">
        <form method="get" action="{{ route('admin.abandoned-carts.index') }}" class="row g-2 align-items-end">
            <div class="col-12 text-end">
                <a class="text-xs me-2" href="{{ route('admin.abandoned-carts.index', ['from' => now()->subDays(6)->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">7 days</a>
                <a class="text-xs me-2" href="{{ route('admin.abandoned-carts.index', ['from' => now()->subDays(29)->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">30 days</a>
                <a class="text-xs" href="{{ route('admin.abandoned-carts.index', ['from' => now()->startOfYear()->format('Y-m-d'), 'to' => now()->format('Y-m-d')]) }}">This year</a>
            </div>

            <div class="col-md-4 col-lg-3">
                <label class="form-label text-xs mb-1">From</label>
                <input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="form-control">
            </div>

            <div class="col-md-4 col-lg-3">
                <label class="form-label text-xs mb-1">To</label>
                <input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="form-control">
            </div>

            <div class="col-md-4 col-lg-4 d-flex gap-2">
                <button type="submit" class="btn bg-gradient-dark mb-0">Apply</button>
                <a href="{{ route('admin.abandoned-carts.index') }}" class="btn btn-outline-secondary mb-0">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-3 col-md-5 col-sm-6">
        <div class="card h-100">
            <div class="card-body p-3">
                <p class="text-sm font-weight-bold mb-1">Abandoned Carts</p>
                <h5 class="font-weight-bolder mb-1">{{ number_format($carts->total()) }}</h5>
                <span class="text-xs text-secondary">Became abandoned within selected period</span>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body px-0 pb-2">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="px-4">Customer</th>
                        <th>Contact</th>
                        <th>Cart Items</th>
                        <th>Checkout Started</th>
                        <th>Abandoned At</th>
                        <th>Reminder</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carts as $cart)
                        @php
                            $items = collect($cart->cart_items ?: []);
                            $user = $cart->user;
                            $abandonedAt = optional($cart->checkout_started_at)->copy()?->addHour();
                        @endphp
                        <tr>
                            <td class="px-4">
                                <span class="text-sm font-weight-bold d-block">{{ $user ? $user->fullname() : 'Unknown customer' }}</span>
                                <span class="text-xs text-secondary">Cart #{{ $cart->id }}</span>
                            </td>
                            <td>
                                <span class="text-sm d-block">{{ optional($user)->email ?: '—' }}</span>
                                <span class="text-xs text-secondary">{{ optional($user)->phone_number ?: '—' }}</span>
                            </td>
                            <td style="min-width: 260px; max-width: 360px;">
                                @if($items->isEmpty())
                                    <span class="text-sm text-secondary">No saved items</span>
                                @else
                                    @foreach($items->take(2) as $item)
                                        <span class="text-sm d-block">{{ \Illuminate\Support\Str::limit($item['name'] ?? ('Product #' . ($item['product_id'] ?? '')), 56) }}</span>
                                    @endforeach
                                    @if($items->count() > 2)
                                        <span class="text-xs text-secondary">+{{ $items->count() - 2 }} more item{{ ($items->count() - 2) === 1 ? '' : 's' }}</span>
                                    @endif
                                @endif
                            </td>
                            <td><span class="text-sm">{{ optional($cart->checkout_started_at)->format('d M Y, H:i') ?: '—' }}</span></td>
                            <td>
                                <span class="text-sm font-weight-bold">{{ $abandonedAt ? $abandonedAt->format('d M Y, H:i') : '—' }}</span>
                            </td>
                            <td>
                                @if($cart->reminder_sent_at)
                                    <span class="badge bg-gradient-success">Sent</span>
                                    <span class="text-xs text-secondary d-block mt-1">{{ $cart->reminder_sent_at->format('d M Y, H:i') }}</span>
                                @else
                                    <span class="badge bg-gradient-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-5">No abandoned carts found in this date range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($carts->hasPages())
            <div class="px-4 pt-3">{{ $carts->links() }}</div>
        @endif
    </div>
</div>
@endsection
