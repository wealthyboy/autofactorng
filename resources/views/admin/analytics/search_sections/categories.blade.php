<div class="card-body px-0">
    <div class="table-responsive">
        <table class="table mb-0">
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td class="px-4 text-sm">{{ $category['name'] }}</td>
                    <td class="text-end px-4">{{ number_format($category['visits']) }}</td>
                </tr>
            @empty
                <tr><td class="text-center py-4">No category activity recorded.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
