<div class="d-lg-flex mb-3">
    <div class="ms-auto my-auto mt-lg-0 mt-4">
        <div class="ms-auto my-auto">
            @if ( isset($models['unique']['add']) && $models['unique']['add'])
            <a href="{{ route($models['routes']['create'][0])  }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Add New</a>
            @endif

            @if ( isset($models['unique']['destroy']) && $models['unique']['destroy'])
            <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-table').submit() : false;" rel="tooltip" title="Remove" class="btn btn-outline-primary btn-sm mb-0">
                Delete
            </a>
            @endif

            @if ( isset($models['unique']['export']) && $models['unique']['export'])
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            @endif
        </div>
    </div>
</div>