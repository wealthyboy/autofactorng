<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockSnapshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockSnapshotController extends Controller
{
    public function store(Request $request)
    {
        $expectedToken = config('services.stock_snapshot.token');
        $incomingToken = $request->bearerToken();

        if (!$expectedToken || !hash_equals($expectedToken, (string) $incomingToken)) {
            return response()->json([
                'message' => 'Unauthorized.',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'batch_id' => ['required', 'string', 'max:100'],
            'source' => ['nullable', 'string', 'max:120'],
            'products' => ['required', 'array', 'min:1', 'max:500'],
            'products.*.id' => ['required', 'integer', 'min:1'],
            'products.*.name' => ['required', 'string', 'max:255'],
            'products.*.quantity' => ['required', 'integer', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid stock snapshot payload.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $created = 0;
        $updated = 0;

        foreach ($request->input('products') as $product) {
            $snapshot = StockSnapshot::updateOrCreate(
                [
                    'batch_id' => $request->input('batch_id'),
                    'product_id' => $product['id'],
                ],
                [
                    'source' => $request->input('source'),
                    'name' => $product['name'],
                    'quantity' => $product['quantity'],
                ]
            );

            $snapshot->wasRecentlyCreated ? $created++ : $updated++;
        }

        return response()->json([
            'message' => 'Stock snapshot saved.',
            'batch_id' => $request->input('batch_id'),
            'received' => count($request->input('products')),
            'created' => $created,
            'updated' => $updated,
        ]);
    }
}
