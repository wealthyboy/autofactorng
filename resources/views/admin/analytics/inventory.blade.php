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
                        <tbody id="oneRemainingProductsBody">
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

                    @if($oneRemainingTotal > 0)
                        <div class="px-4 pt-3 pb-1 text-center" id="oneRemainingLoaderArea">
                            <p class="text-xs text-secondary mb-2" id="oneRemainingStatus" aria-live="polite">
                                Showing {{ number_format($oneRemaining->count()) }} of {{ number_format($oneRemainingTotal) }} products
                            </p>

                            @if($oneRemainingTotal > $oneRemaining->count())
                                <button
                                    type="button"
                                    class="btn btn-outline-dark btn-sm mb-0"
                                    id="loadMoreOneRemaining"
                                    data-url="{{ route('admin.analytics.inventory.one-remaining') }}"
                                    data-offset="{{ $oneRemaining->count() }}"
                                    data-limit="{{ $oneRemainingBatchSize }}"
                                >
                                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                                    <span class="load-more-label">Load more</span>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('loadMoreOneRemaining');

            if (!button) {
                return;
            }

            const tbody = document.getElementById('oneRemainingProductsBody');
            const status = document.getElementById('oneRemainingStatus');
            const spinner = button.querySelector('.spinner-border');
            const label = button.querySelector('.load-more-label');

            const appendProduct = function (product) {
                const row = document.createElement('tr');

                const productCell = document.createElement('td');
                productCell.className = 'px-4 analytics-product-column';

                const link = document.createElement('a');
                link.href = product.edit_url;
                link.className = 'text-sm font-weight-bold analytics-product-name';
                link.textContent = product.name;

                const sku = document.createElement('span');
                sku.className = 'text-xs text-secondary analytics-product-sku';
                sku.textContent = product.sku || 'No SKU';

                productCell.appendChild(link);
                productCell.appendChild(sku);

                const quantityCell = document.createElement('td');
                quantityCell.className = 'text-end px-4 font-weight-bold analytics-number-column';
                quantityCell.textContent = Number(product.quantity || 0).toLocaleString();

                row.appendChild(productCell);
                row.appendChild(quantityCell);
                tbody.appendChild(row);
            };

            button.addEventListener('click', async function () {
                if (button.disabled) {
                    return;
                }

                button.disabled = true;
                spinner.classList.remove('d-none');
                label.textContent = 'Loading...';

                if (status) {
                    status.classList.remove('text-danger');
                    status.classList.add('text-secondary');
                }

                try {
                    const url = new URL(button.dataset.url, window.location.origin);
                    url.searchParams.set('offset', button.dataset.offset || '0');
                    url.searchParams.set('limit', button.dataset.limit || '50');

                    const response = await fetch(url.toString(), {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    });

                    if (!response.ok) {
                        throw new Error('Unable to load more products.');
                    }

                    const data = await response.json();
                    (data.items || []).forEach(appendProduct);

                    button.dataset.offset = String(data.next_offset || button.dataset.offset || 0);

                    if (status) {
                        const shown = Math.min(Number(data.next_offset || 0), Number(data.total || 0));
                        status.textContent = 'Showing ' + shown.toLocaleString()
                            + ' of ' + Number(data.total || 0).toLocaleString() + ' products';
                    }

                    if (!data.has_more) {
                        button.remove();
                    }
                } catch (error) {
                    if (status) {
                        status.textContent = 'Could not load more products. Please try again.';
                        status.classList.remove('text-secondary');
                        status.classList.add('text-danger');
                    }
                } finally {
                    if (document.body.contains(button)) {
                        button.disabled = false;
                        spinner.classList.add('d-none');
                        label.textContent = 'Load more';
                    }
                }
            });
        });
    </script>
@endsection
