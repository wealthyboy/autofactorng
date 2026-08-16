<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">{{ $title }}</h4>
        <p class="text-sm text-secondary mb-0">{{ $description }}</p>
    </div>
    <form method="get" class="row g-2 align-items-end mt-2 mt-md-0">
        <div class="col-12 text-end">
            <a class="text-xs me-2" href="{{ request()->url() }}?from={{ now()->subDays(6)->format('Y-m-d') }}&to={{ now()->format('Y-m-d') }}">7 days</a>
            <a class="text-xs me-2" href="{{ request()->url() }}?from={{ now()->subDays(29)->format('Y-m-d') }}&to={{ now()->format('Y-m-d') }}">30 days</a>
            <a class="text-xs" href="{{ request()->url() }}?from={{ now()->startOfYear()->format('Y-m-d') }}&to={{ now()->format('Y-m-d') }}">This year</a>
        </div>
        <div class="col-auto"><label class="form-label text-xs mb-1">From</label><input type="date" name="from" value="{{ $from->format('Y-m-d') }}" class="form-control"></div>
        <div class="col-auto"><label class="form-label text-xs mb-1">To</label><input type="date" name="to" value="{{ $to->format('Y-m-d') }}" class="form-control"></div>
        <div class="col-auto"><button class="btn bg-gradient-dark mb-0">Apply</button></div>
    </form>
</div>

<div class="row mb-4">
    @foreach($stats as $stat)
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card h-100"><div class="card-body p-3">
                <p class="text-sm font-weight-bold text-capitalize mb-1">{{ $stat['label'] }}</p>
                <h5 class="font-weight-bolder mb-1">{{ $stat['value'] }}</h5>
                <span class="text-xs text-secondary">{{ $stat['hint'] }}</span>
            </div></div>
        </div>
    @endforeach
</div>
