@extends('admin.layouts.app')

@section('content')
@include('admin.analytics._header', [
    'title' => 'Search analytics',
    'description' => 'Search demand and the products and categories visitors explore.',
    'stats' => [],
])

<div id="search-analytics-summary"
     data-url="{{ route('admin.analytics.search.section', ['section' => 'summary', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
     class="row mb-4 analytics-async-section">
    @for($i = 0; $i < 4; $i++)
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card h-100">
                <div class="card-body p-3 d-flex align-items-center justify-content-center" style="min-height: 118px;">
                    <div class="text-center text-secondary">
                        <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>
                        <div class="text-xs mt-2">Loading summary...</div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0"><h6>Most searched terms</h6></div>
            <div id="search-analytics-terms"
                 data-url="{{ route('admin.analytics.search.section', ['section' => 'terms', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
                 class="analytics-async-section">
                @include('admin.analytics.search_sections._loader', ['label' => 'search terms'])
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0"><h6>Most viewed products</h6></div>
            <div id="search-analytics-products"
                 data-url="{{ route('admin.analytics.search.section', ['section' => 'products', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
                 class="analytics-async-section">
                @include('admin.analytics.search_sections._loader', ['label' => 'product views'])
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0"><h6>Top categories explored</h6></div>
            <div id="search-analytics-categories"
                 data-url="{{ route('admin.analytics.search.section', ['section' => 'categories', 'from' => $from->format('Y-m-d'), 'to' => $to->format('Y-m-d')]) }}"
                 class="analytics-async-section">
                @include('admin.analytics.search_sections._loader', ['label' => 'category activity'])
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script>
(function () {
    'use strict';

    function showError(target) {
        target.innerHTML = [
            '<div class="card-body text-center py-5">',
            '<p class="text-sm text-secondary mb-3">This section could not be loaded.</p>',
            '<button type="button" class="btn btn-sm bg-gradient-dark mb-0 analytics-retry">Retry</button>',
            '</div>'
        ].join('');

        var retry = target.querySelector('.analytics-retry');
        if (retry) {
            retry.addEventListener('click', function () {
                loadSection(target);
            });
        }
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
        var summary = document.getElementById('search-analytics-summary');
        var detailSections = [
            document.getElementById('search-analytics-terms'),
            document.getElementById('search-analytics-products'),
            document.getElementById('search-analytics-categories')
        ];

        // Load the small KPI summary first, then progressively fill the three
        // report cards. The page itself is already usable while these run.
        loadSection(summary).finally(function () {
            detailSections.forEach(function (section, index) {
                setTimeout(function () {
                    loadSection(section);
                }, index * 150);
            });
        });
    });
})();
</script>
@endsection
