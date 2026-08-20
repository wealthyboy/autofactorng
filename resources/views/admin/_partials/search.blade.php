@if (isset($models['unique']['search']) && $models['unique']['search'])
<div class="card mb-3">
    <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 me-3 float-start">
            <i class="material-symbols-outlined">filter_alt</i>
        </div>
        <h6 class="mb-0">FIlter</h6>
    </div>
    <div class="card-body pt-0">
        <form action="" method="get">
            <div class="row">
                <div class="{{ !empty($models['unique']['customer_classes']) ? 'col-md-8' : 'col-sm-12' }} col-12 mb-3">
                    <div class="input-group input-group-outline is-filled">
                        <label class="form-label">Search</label>
                        <input name="gq" value="{{ request('gq') }}" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                @if (!empty($models['unique']['customer_classes']))
                <div class="col-md-4 col-12 mb-3">
                    <div class="input-group input-group-outline is-filled">
                        <label class="form-label">Customer Class</label>
                        <select name="customer_class" class="form-control">
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
