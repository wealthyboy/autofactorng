<div class="card mb-4">
    <div class="card-header pb-0"><h6>Daily performance</h6></div>
    <div class="card-body"><div style="height: 320px"><canvas id="analyticsTrend"></canvas></div></div>
</div>

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
@endsection
@section('inline-scripts')
const analyticsCanvas = document.getElementById('analyticsTrend');
if (analyticsCanvas) {
    new Chart(analyticsCanvas, {
        type: 'line',
        data: {
            labels: @json($trend['labels']),
            datasets: [
                { label: 'Revenue (₦)', data: @json($trend['revenue']), borderColor: '#e91e63', backgroundColor: 'rgba(233,30,99,.08)', yAxisID: 'revenue', tension: .35, fill: true },
                { label: 'Orders', data: @json($trend['orders']), borderColor: '#344767', backgroundColor: '#344767', yAxisID: 'orders', tension: .35 }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false }, scales: { revenue: { beginAtZero: true, position: 'left' }, orders: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false }, ticks: { precision: 0 } } } }
    });
}
@endsection
