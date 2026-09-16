@if (isset($models['unique']['search']) && $models['unique']['search'])
<style>
    .admin-filter-form .admin-filter-field {
        display: block;
    }

    .admin-filter-form .admin-filter-label {
        display: block;
        position: static !important;
        transform: none !important;
        margin: 0 0 0.5rem 0;
        padding: 0;
        color: #344767;
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .admin-filter-form .admin-filter-control {
        display: block;
        width: 100%;
        min-height: 42px;
        padding: 0.625rem 0.75rem;
        color: #495057;
        background-color: #fff;
        border: 1px solid #d2d6da !important;
        border-radius: 0.5rem !important;
        box-shadow: none !important;
        outline: none !important;
    }

    .admin-filter-form .admin-filter-control:focus {
        border-color: #344767 !important;
        box-shadow: none !important;
        outline: none !important;
    }
</style>
<div class="card mb-3">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-symbols-outlined">filter_alt</i>
        </div>
        <h6 class="mb-0">Filter</h6>
    </div>
    <div class="card-body pt-0">
        <form action="" method="get" class="admin-filter-form">
            <div class="row">
                <div class="{{ !empty($models['unique']['customer_classes']) ? 'col-md-8' : 'col-sm-12' }} col-12 mb-3">
                    <div class="admin-filter-field">
                        <label class="admin-filter-label" for="admin-filter-search">Search</label>
                        <input id="admin-filter-search" name="gq" value="{{ request('gq') }}" type="text" class="form-control admin-filter-control" placeholder="">
                    </div>
                </div>
                @if (!empty($models['unique']['customer_classes']))
                <div class="col-md-4 col-12 mb-3">
                    <div class="admin-filter-field">
                        <label class="admin-filter-label" for="admin-filter-customer-class">Customer Class</label>
                        <select id="admin-filter-customer-class" name="customer_class" class="form-control admin-filter-control">
                            <option value="">All Classes</option>
                            @foreach ($models['unique']['customer_classes'] as $class => $label)
                            <option value="{{ $class }}" {{ request('customer_class') === $class ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>
            <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-2 mb-0">Search</button>
            @if (!empty($models['unique']['customer_classes']))
            <a href="{{ request()->url() }}" class="btn btn-outline-secondary btn-sm float-end mt-2 mb-0 me-2">Reset</a>
            @endif
        </form>
    </div>
</div>
@endif
