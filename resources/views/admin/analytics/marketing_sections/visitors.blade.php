@foreach($stats as $stat)
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card h-100">
            <div class="card-body p-3">
                <p class="text-sm font-weight-bold text-capitalize mb-1">{{ $stat['label'] }}</p>
                <h5 class="font-weight-bolder mb-1">{{ $stat['value'] }}</h5>
                <span class="text-xs text-secondary">{{ $stat['hint'] }}</span>
            </div>
        </div>
    </div>
@endforeach
