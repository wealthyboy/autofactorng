@extends('admin.layouts.app')

@section('content')
@include('admin.analytics._header', [
    'title' => 'Marketing analytics',
    'description' => 'Visitors, acquisition and checkout behaviour.',
    'stats' => [],
])

<div id="marketing-analytics-visitors"
     data-url="{{ route('admin.analytics.marketing.section', ['section' => 'visitors', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
     class="row mb-1 analytics-async-section">
    @for($i = 0; $i < 4; $i++)
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-center" style="min-height: 118px;">
                    <div class="text-center text-secondary">
                        <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>
                        <div class="text-xs mt-2">Loading visitor summary...</div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>

<div id="marketing-analytics-checkout"
     data-url="{{ route('admin.analytics.marketing.section', ['section' => 'checkout', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
     class="row mb-1 analytics-async-section">
    @for($i = 0; $i < 4; $i++)
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-center" style="min-height: 118px;">
                    <div class="text-center text-secondary">
                        <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>
                        <div class="text-xs mt-2">Loading checkout summary...</div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>

<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0"><h6>Visitor trend — selected period</h6></div>
            <div id="marketing-analytics-chart"
                 data-url="{{ route('admin.analytics.marketing.section', ['section' => 'chart', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
                 class="analytics-async-section">
                @include('admin.analytics.marketing_sections._loader', ['label' => 'visitor trend'])
            </div>
        </div>
    </div>

    <div class="col-lg-5 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0"><h6>Visitor acquisition sources</h6></div>
            <div id="marketing-analytics-sources"
                 data-url="{{ route('admin.analytics.marketing.section', ['section' => 'sources', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
                 class="analytics-async-section">
                @include('admin.analytics.marketing_sections._loader', ['label' => 'acquisition sources'])
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
(function () {
    'use strict';

    var marketingChart = null;

    function showError(target) {
        var isRow = target.classList.contains('row');
        var wrapperStart = isRow ? '<div class="col-12">' : '';
        var wrapperEnd = isRow ? '</div>' : '';

        target.innerHTML = wrapperStart + [
            '<div class="card-body text-center py-5">',
            '<p class="text-sm text-secondary mb-3">This section could not be loaded.</p>',
            '<button type="button" class="btn btn-sm bg-gradient-dark mb-0 analytics-retry">Retry</button>',
            '</div>'
        ].join('') + wrapperEnd;

        var retry = target.querySelector('.analytics-retry');
        if (retry) {
            retry.addEventListener('click', function () {
                loadSection(target);
            });
        }
    }

    function renderChart(target) {
        if (!target || typeof Chart === 'undefined') {
            return;
        }

        var canvas = target.querySelector('#marketingVisitorChart');
        var payloadNode = target.querySelector('.marketing-chart-data');
        if (!canvas || !payloadNode) {
            return;
        }

        var payload;
        try {
            payload = JSON.parse(payloadNode.textContent || '{}');
        } catch (error) {
            return;
        }

        if (marketingChart) {
            marketingChart.destroy();
        }

        marketingChart = new Chart(canvas, {
            type: 'line',
            data: {
                labels: payload.labels || [],
                datasets: (payload.datasets || []).map(function (dataset) {
                    return Object.assign({}, dataset, {
                        borderColor: dataset.color,
                        backgroundColor: dataset.color,
                        tension: 0.35
                    });
                })
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    }

    function loadSection(target) {
        if (!target || !target.dataset.url) {
            return Promise.resolve();
        }

        var controller = typeof AbortController !== 'undefined' ? new AbortController() : null;
        var timeout = controller ? setTimeout(function () { controller.abort(); }, 45000) : null;
        var options = {
            headers: {
                'Accept': 'text/html',
                'X-Requested-With': 'XMLHttpRequest'
            },
            cache: 'no-store',
            credentials: 'same-origin'
        };

        if (controller) {
            options.signal = controller.signal;
        }

        return fetch(target.dataset.url, options)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Analytics request failed with HTTP ' + response.status);
                }
                return response.text();
            })
            .then(function (html) {
                target.innerHTML = html;
                if (target.id === 'marketing-analytics-chart') {
                    renderChart(target);
                }
            })
            .catch(function () {
                showError(target);
            })
            .finally(function () {
                if (timeout) {
                    clearTimeout(timeout);
                }
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var sections = [
            document.getElementById('marketing-analytics-visitors'),
            document.getElementById('marketing-analytics-checkout'),
            document.getElementById('marketing-analytics-chart'),
            document.getElementById('marketing-analytics-sources')
        ];

        sections.forEach(function (section, index) {
            setTimeout(function () {
                loadSection(section);
            }, index * 120);
        });
    });
})();
</script>
@endsection
