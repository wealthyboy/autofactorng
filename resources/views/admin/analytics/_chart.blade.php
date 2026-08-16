<div class="card mb-4">
    <div class="card-header pb-0"><h6>{{ $chartTitle }}</h6></div>
    <div class="card-body"><div style="height: 320px"><canvas id="analyticsMultiChart"></canvas></div></div>
</div>

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
@endsection
@section('inline-scripts')
const analyticsMultiCanvas = document.getElementById('analyticsMultiChart');
if (analyticsMultiCanvas && typeof Chart !== 'undefined') {
    const analyticsChartPayload = @json($chart);
    new Chart(analyticsMultiCanvas, {
        type: 'line',
        data: {
            labels: analyticsChartPayload.labels,
            datasets: analyticsChartPayload.datasets.map(function (dataset) {
                return Object.assign({}, dataset, {
                    borderColor: dataset.color,
                    backgroundColor: dataset.color,
                    tension: .35
                });
            })
        },
        options: { responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
}
@endsection
