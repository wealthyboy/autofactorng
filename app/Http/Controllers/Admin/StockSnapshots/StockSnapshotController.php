<?php

namespace App\Http\Controllers\Admin\StockSnapshots;

use App\Http\Controllers\Controller;
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

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $snapshots = $query
            ->orderBy('created_at', 'desc')
            ->orderBy('product_id')
            ->paginate(50)
            ->withQueryString();

        return view('admin.stock_snapshots.index', compact('snapshots'));
    }
}
