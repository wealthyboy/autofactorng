    <div class="results ">
        {!! __('Showing') !!}
        @if ($name->firstItem())
            <span class="font-medium">{{ $name->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $name->lastItem() }}</span>
        @else
            {{ $name->count() }}
        @endif
        {!! __('of') !!}
        <span class="font-medium">{{ $name->total() }}</span>
        {!! __('results') !!}
    </div>
    {{ $name->links('vendor.pagination.bootstrap-4') }}
