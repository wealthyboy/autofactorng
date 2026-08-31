@extends('admin.layouts.app')

@section('content')
    @include('admin.analytics._header', [
        'title' => 'Inventory analytics',
        'description' => 'Stock value, stock-outs and inventory movement.'
    ])

    <style>
        .analytics-inventory-table {
            width: 100%;
            table-layout: fixed;
        }

        .analytics-inventory-table .analytics-product-column {
            width: auto;
            min-width: 0;
        }

        .analytics-inventory-table .analytics-number-column {
            width: 110px;
            white-space: nowrap;
        }

        .analytics-inventory-table .analytics-product-name,
        .analytics-inventory-table .analytics-product-sku {
            display: block;
            max-width: 100%;
            min-width: 0;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        @media (max-width: 575.98px) {
            .analytics-inventory-table .analytics-number-column {
                width: 82px;
            }

            .analytics-inventory-table th,
            .analytics-inventory-table td {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }
    </style>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Inventory sold</h6>
                </div>

                <div class="card-body px-0">
                    <table class="table mb-0 analytics-inventory-table">
                        <thead>
                            <tr>
                                <th class="analytics-product-column">Product</th>
                                <th class="text-end analytics-number-column">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentlySold as $product)
                                <tr>
                                    <td class="px-4 text-sm analytics-product-column">
                                        <span class="analytics-product-name">{{ $product->name }}</span>
                                    </td>
                                    <td class="text-end px-4 analytics-number-column">
                                        {{ number_format($product->units) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">No sales in period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Items remaining 1 in quantity</h6>
                    <p class="text-xs text-secondary mb-0">Current products with exactly one unit left</p>
                </div>

                <div class="card-body px-0">
                    <table class="table mb-0 analytics-inventory-table">
                        <thead>
                            <tr>
                                <th class="analytics-product-column">Product</th>
                                <th class="text-end analytics-number-column">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($oneRemaining as $product)
                                <tr>
                                    <td class="px-4 analytics-product-column">
                                        <a
                                            href="{{ route('products.edit', $product->id) }}"
                                            class="text-sm font-weight-bold analytics-product-name"
                                        >
                                            {{ $product->name }}
                                        </a>
                                        <span class="text-xs text-secondary analytics-product-sku">
                                            {{ $product->sku ?: 'No SKU' }}
                                        </span>
                                    </td>
                                    <td class="text-end px-4 font-weight-bold analytics-number-column">
                                        {{ number_format($product->quantity) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">
                                        No products currently have exactly one unit left.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
