<div class="card-body px-0">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="px-4 text-xs text-uppercase text-secondary">Search term</th>
                    <th class="text-center text-xs text-uppercase text-secondary">Attempts</th>
                    <th class="text-end px-4 text-xs text-uppercase text-secondary">Last searched</th>
                </tr>
            </thead>
            <tbody>
                @forelse($searches as $search)
                    <tr>
                        <td class="px-4">
                            <span class="text-sm font-weight-bold">{{ $search['query'] }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-gradient-warning">{{ number_format($search['attempts']) }}</span>
                        </td>
                        <td class="text-end px-4 text-sm text-secondary">
                            {{ $search['last_searched_at'] ? $search['last_searched_at']->format('d M Y, H:i') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-secondary py-5">
                            No zero-result searches have been recorded in this date range.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
