@foreach($stats as $stat)
    <div class="col-xl-3 col-sm-6 mb-3">
        @if($stat['label'] === 'Abandoned Carts')
            <a href="{{ route('admin.abandoned-carts.index', ['from' => request('from'), 'to' => request('to')]) }}" class="text-decoration-none">
        @endif
        <div class="card h-100">
            <div class="card-body p-3">
                <p class="text-sm font-weight-bold text-capitalize mb-1">{{ $stat['label'] }}</p>
                <h5 class="font-weight-bolder mb-1">{{ $stat['value'] }}</h5>
                <span class="text-xs text-secondary">{{ $stat['hint'] }}</span>
                @if($stat['label'] === 'Abandoned Carts')
                    <span class="text-xs font-weight-bold d-block mt-2">View abandoned carts →</span>
                @endif
            </div>
        </div>
        @if($stat['label'] === 'Abandoned Carts')
            </a>
        @endif
    </div>
@endforeach
