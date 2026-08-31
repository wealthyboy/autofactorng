@extends('admin.layouts.app')

@section('content')
    <style>
        .analytics-search-card {
            min-width: 0;
            overflow: hidden;
        }

        .analytics-search-table {
            width: 100%;
            table-layout: fixed;
        }

        .analytics-search-table td {
            vertical-align: top;
            white-space: normal !important;
        }

        .analytics-search-table .analytics-label-column {
            width: auto;
            min-width: 0;
        }

        .analytics-search-table .analytics-count-column {
            width: 82px;
            white-space: nowrap !important;
        }

        .analytics-search-label {
            display: block;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            white-space: normal !important;
            overflow-wrap: anywhere;
            word-break: break-word;
            line-height: 1.4;
        }

        @media (max-width: 575.98px) {
            .analytics-search-table .analytics-count-column {
                width: 64px;
            }

            .analytics-search-table td {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }
    </style>

    @include('admin.analytics._header', [
        'title' => 'Search analytics',
        'description' => 'Search demand and the products and categories visitors explore.'
    ])

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100 analytics-search-card">
                <div class="card-header pb-0">
                    <h6>Most searched terms</h6>
                </div>

                <div class="card-body px-0">
                    <table class="table mb-0 analytics-search-table">
                        <tbody>
                            @forelse($terms as $term => $count)
                                <tr>
                                    <td class="px-4 text-sm analytics-label-column">
                                        <span class="analytics-search-label">{{ $term }}</span>
                                    </td>
                                    <td class="text-end px-4 analytics-count-column">
                                        {{ number_format($count) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">No search terms recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-100 analytics-search-card">
                <div class="card-header pb-0">
                    <h6>Most viewed products</h6>
                </div>

                <div class="card-body px-0">
                    <table class="table mb-0 analytics-search-table">
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td class="px-4 text-sm analytics-label-column">
                                        <span class="analytics-search-label">{{ $product->name }}</span>
                                    </td>
                                    <td class="text-end px-4 analytics-count-column">
                                        {{ number_format($product->views) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">No product views recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-100 analytics-search-card">
                <div class="card-header pb-0">
                    <h6>Top categories explored</h6>
                </div>

                <div class="card-body px-0">
                    <table class="table mb-0 analytics-search-table">
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td class="px-4 text-sm analytics-label-column">
                                        <span class="analytics-search-label">{{ $category->name }}</span>
                                    </td>
                                    <td class="text-end px-4 analytics-count-column">
                                        {{ number_format($category->visits) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">No category activity recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
