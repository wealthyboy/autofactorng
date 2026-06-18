<?php

namespace App\Http\Controllers\Admin\StockSnapshots;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockSnapshot;
use Illuminate\Http\Request;

class StockSnapshotController extends Controller
{
    public function index(Request $request)
    {
        $query = StockSnapshot::query();

        if ($request->filled('batch_id')) {
            $query->where('batch_id', 'like', '%' . $request->batch_id . '%');
        }

        if ($request->filled('source')) {
            $query->where('source', 'like', '%' . $request->source . '%');
        }

        if ($request->filled('name')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('product_name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->boolean('migrate')) {
            $updated = 0;
            $missing = 0;

            (clone $query)
                ->select('id', 'quantity')
                ->orderBy('id')
                ->chunkById(200, function ($snapshots) use (&$updated, &$missing) {
                    foreach ($snapshots as $snapshot) {
                        $affected = Product::where('id', $snapshot->id)->update([
                            'quantity' => $snapshot->quantity,
                        ]);

                        $affected ? $updated++ : $missing++;
                    }
                });

            return redirect()
                ->route('admin.stock-snapshots.index', $request->except('migrate'))
                ->with('message', "Product quantities migrated from stock snapshots. Updated: {$updated}. Missing products: {$missing}.");
        }

        $snapshots = $query
            ->orderBy('created_at', 'desc')
            ->orderBy('id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.stock_snapshots.index', compact('snapshots'));
    }
}
