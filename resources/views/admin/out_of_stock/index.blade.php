@extends('admin.layouts.app')

@section('page-styles')
<style>
    .stock-report-hero {
        background: linear-gradient(135deg, #1f2937 0%, #111827 55%, #374151 100%);
        border-radius: 18px;
        overflow: hidden;
        position: relative;
    }
    .stock-report-hero::after {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        right: -70px;
        top: -100px;
        background: rgba(255,255,255,.08);
    }
    .stock-stat-card, .stock-panel {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .06);
    }
    .stock-stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
    }
    .stock-tabs .nav-link {
        border: 0;
        border-radius: 10px;
        color: #64748b;
        font-weight: 600;
        padding: .7rem 1rem;
    }
    .stock-tabs .nav-link.active {
        color: #fff;
        background: #111827;
        box-shadow: 0 4px 12px rgba(17,24,39,.18);
    }
    .stock-filter .form-control,
    .stock-filter .form-select {
        border: 1px solid #dbe2ea !important;
        border-radius: 10px;
        padding: .7rem .85rem;
        background-color: #fff;
    }
    .stock-table thead th {
        color: #64748b;
        text-transform: uppercase;
        font-size: .68rem;
        letter-spacing: .05em;
        border-bottom-width: 1px;
        white-space: nowrap;
    }
    .stock-table td {
        vertical-align: middle;
    }
    .stock-category-chip {
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        border-radius: 999px;
        padding: .25rem .55rem;
        font-size: .72rem;
        margin: 2px;
    }
    .category-count-row:hover {
        background: #f8fafc;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="stock-report-hero p-4 p-lg-5 mb-4 text-white">
            <div class="position-relative" style="z-index:1;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="material-symbols-outlined">inventory</span>
                            <span class="text-uppercase text-xs font-weight-bold opacity-8">Inventory report</span>
                        </div>
                        <h3 class="text-white mb-2">Out of Stock Products</h3>
                        <p class="text-white opacity-8 mb-0">See every unavailable item at a glance or review stock shortages category by category.</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-light mb-0">
                        <span class="material-symbols-outlined align-middle me-1" style="font-size:18px;">inventory_2</span>
                        All Products
                    </a>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-6 col-xl-3 mb-3 mb-xl-0">
                <div class="card stock-stat-card h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm text-muted mb-1">Total Out of Stock</p>
                            <h3 class="mb-0">{{ number_format($totalOutOfStock) }}</h3>
                        </div>
                        <div class="stock-stat-icon text-danger"><span class="material-symbols-outlined">production_quantity_limits</span></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-3 mb-xl-0">
                <div class="card stock-stat-card h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm text-muted mb-1">Active Products</p>
                            <h3 class="mb-0">{{ number_format($activeOutOfStock) }}</h3>
                        </div>
                        <div class="stock-stat-icon text-warning"><span class="material-symbols-outlined">visibility</span></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-3 mb-sm-0">
                <div class="card stock-stat-card h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm text-muted mb-1">Affected Categories</p>
                            <h3 class="mb-0">{{ number_format($affectedCategories) }}</h3>
                        </div>
                        <div class="stock-stat-icon text-info"><span class="material-symbols-outlined">category</span></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card stock-stat-card h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm text-muted mb-1">Uncategorized</p>
                            <h3 class="mb-0">{{ number_format($uncategorizedCount) }}</h3>
                        </div>
                        <div class="stock-stat-icon text-secondary"><span class="material-symbols-outlined">folder_off</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card stock-panel mb-4">
            <div class="card-body p-3">
                <ul class="nav stock-tabs gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ $view === 'general' ? 'active' : '' }}" href="{{ route('admin.out-of-stock-products.index', ['view' => 'general']) }}">
                            <span class="material-symbols-outlined align-middle me-1" style="font-size:18px;">view_list</span>
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $view === 'category' ? 'active' : '' }}" href="{{ route('admin.out-of-stock-products.index', ['view' => 'category']) }}">
                            <span class="material-symbols-outlined align-middle me-1" style="font-size:18px;">account_tree</span>
                            Per Category
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        @if($view === 'category')
            <div class="card stock-panel mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Out of Stock by Category</h5>
                        <p class="text-sm text-muted mb-0">Choose a category to see the affected products.</p>
                    </div>
                    <span class="badge bg-gradient-dark">{{ number_format($affectedCategories) }} categories</span>
                </div>
                <div class="card-body table-responsive pt-3">
                    <table class="table align-items-center mb-0 stock-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th class="text-center">Out of Stock Items</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categoryCounts as $category)
                                <tr class="category-count-row">
                                    <td class="font-weight-bold text-sm">{{ $category->name }}</td>
                                    <td class="text-center"><span class="badge bg-gradient-danger">{{ number_format($category->out_of_stock_count) }}</span></td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-outline-dark mb-0" href="{{ route('admin.out-of-stock-products.index', ['view' => 'category', 'category_id' => $category->id]) }}">View Items</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-5 text-muted">No categories currently have out of stock products.</td></tr>
                            @endforelse
                            @if($uncategorizedCount > 0)
                                <tr class="category-count-row">
                                    <td class="font-weight-bold text-sm">Uncategorized</td>
                                    <td class="text-center"><span class="badge bg-gradient-secondary">{{ number_format($uncategorizedCount) }}</span></td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-outline-dark mb-0" href="{{ route('admin.out-of-stock-products.index', ['view' => 'category', 'category_id' => 'uncategorized']) }}">View Items</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if($view === 'general' || $products)
            <div class="card stock-panel">
                <div class="card-header pb-0">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2">
                        <div>
                            <h5 class="mb-1">{{ $view === 'category' && $selectedCategoryName ? $selectedCategoryName . ' - Out of Stock' : 'All Out of Stock Items' }}</h5>
                            <p class="text-sm text-muted mb-0">Search and filter out-of-stock products from this report.</p>
                        </div>
                        @if($view === 'category' && $selectedCategory)
                            <a href="{{ route('admin.out-of-stock-products.index', ['view' => 'category']) }}" class="btn btn-outline-secondary btn-sm mb-0">Back to Categories</a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('admin.out-of-stock-products.index') }}" class="stock-filter mb-4">
                        <input type="hidden" name="view" value="{{ $view }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-lg-5">
                                <label class="form-label text-sm">Search Product</label>
                                <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Name, SKU or barcode">
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label text-sm">Category</label>
                                <select class="form-select" name="category_id">
                                    <option value="">All categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                    @if($uncategorizedCount > 0)
                                        <option value="uncategorized" {{ request('category_id') === 'uncategorized' ? 'selected' : '' }}>Uncategorized</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label text-sm">Per Page</label>
                                <select class="form-select" name="per_page">
                                    @foreach([25, 50, 100] as $size)
                                        <option value="{{ $size }}" {{ (int) $perPage === $size ? 'selected' : '' }}>{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 d-flex gap-2">
                                <button type="submit" class="btn bg-gradient-dark mb-0 flex-fill">Apply</button>
                                <a href="{{ route('admin.out-of-stock-products.index', ['view' => $view]) }}" class="btn btn-outline-secondary mb-0">Reset</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 stock-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Categories</th>
                                    <th>Brand</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Visibility</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                   class="text-sm font-weight-bold text-dark text-decoration-none">
                                                    {{ $product->name ?: $product->product_name ?: 'Unnamed product' }}
                                                </a>
                                                <span class="text-xs text-muted">ID #{{ $product->id }}</span>
                                            </div>
                                        </td>
                                        <td class="text-sm">{{ $product->sku ?: '-' }}</td>
                                        <td style="min-width:220px;">
                                            @forelse($product->categories as $category)
                                                <span class="stock-category-chip">{{ $category->name }}</span>
                                            @empty
                                                <span class="text-xs text-muted">Uncategorized</span>
                                            @endforelse
                                        </td>
                                        <td class="text-sm">{{ optional($product->brand)->name ?: '-' }}</td>
                                        <td class="text-center"><span class="badge bg-gradient-danger">{{ number_format($product->quantity) }}</span></td>
                                        <td class="text-center">
                                            @if($product->allow)
                                                <span class="badge bg-gradient-success">Active</span>
                                            @else
                                                <span class="badge bg-gradient-secondary">Hidden</span>
                                            @endif
                                        </td>
                                        <td class="text-end text-nowrap">
                                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-outline-secondary mb-0">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <span class="material-symbols-outlined text-success mb-2" style="font-size:42px;">inventory</span>
                                            <h6 class="mb-1">No out of stock products found</h6>
                                            <p class="text-sm text-muted mb-0">There are no items matching the current filters.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($products && $products->hasPages())
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mt-4">
                            <p class="text-sm text-muted mb-0">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ number_format($products->total()) }} items</p>
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
