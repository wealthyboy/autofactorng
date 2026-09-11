<div class="card-body px-0">
    <div class="table-responsive">
        <table class="table mb-0">
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="px-4 text-sm">{{ $product['name'] }}</td>
                    <td class="text-end px-4">{{ number_format($product['views']) }}</td>
                </tr>
            @empty
                <tr><td class="text-center py-4">No product views recorded.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
