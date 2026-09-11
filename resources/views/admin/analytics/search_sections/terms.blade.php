<div class="card-body px-0">
    <div class="table-responsive">
        <table class="table mb-0">
            <tbody>
            @forelse($terms as $term => $count)
                <tr>
                    <td class="px-4 text-sm">{{ $term }}</td>
                    <td class="text-end px-4">{{ number_format($count) }}</td>
                </tr>
            @empty
                <tr><td class="text-center py-4">No search terms recorded.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
