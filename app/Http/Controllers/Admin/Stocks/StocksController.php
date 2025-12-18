<?php

namespace App\Http\Controllers\Admin\Stocks;

use App\Models\Stock;

class StocksController
{
    public function index()
    {
        // Get all stocks ordered by latest first
        $stocks = Stock::orderBy('created_at', 'desc')->get();

        // Pass to the view
        return view('admin.stocks.index', compact('stocks'));
    }
}
