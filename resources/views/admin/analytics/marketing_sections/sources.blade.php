<div class="card-body px-0">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr><th class="px-4">Source</th><th class="text-end px-4">Visitors</th></tr>
            </thead>
            <tbody>
            @forelse($sources as $source)
                <tr>
                    <td class="px-4 text-sm font-weight-bold">{{ $source['source'] }}</td>
                    <td class="text-end px-4">{{ number_format($source['visitors']) }}</td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center py-4">No visitor data in period.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
