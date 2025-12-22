<?php

namespace App\Http\Controllers\Admin\Stocks;

use App\Models\Stock;

class StocksController
{
    public function index(Request $request)
    {
        $query = Stock::query();

        // Filter by date (from / to)
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Latest first + pagination
        $stocks = $query
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString(); // keeps filters when paginating

        return view('admin.stocks.index', compact('stocks'));
    }
}
