<?php

namespace App\Http\Controllers\Admin\AbandonedCarts;

use App\Http\Controllers\Controller;
use App\Models\AbandonedCart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbandonedCartsController extends Controller
{
    /**
     * Show unrecovered checkout attempts that became abandoned during the
     * selected date range. A checkout becomes abandoned one hour after
     * checkout_started_at, matching the Marketing Analytics definition.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        $to = isset($validated['to'])
            ? Carbon::parse($validated['to'])->endOfDay()
            : now()->endOfDay();

        $from = isset($validated['from'])
            ? Carbon::parse($validated['from'])->startOfDay()
            : now()->subDays(29)->startOfDay();

        $now = now();
        $effectiveTo = $to->lt($now) ? $to->copy() : $now;

        $query = AbandonedCart::query()
            ->with(['user:id,name,last_name,email,phone_number'])
            ->where('recovered', false)
            ->whereNotNull('checkout_started_at');

        if ($from->lte($effectiveTo)) {
            $query->whereBetween('checkout_started_at', [
                $from->copy()->subHour(),
                $effectiveTo->copy()->subHour(),
            ]);
        } else {
            // A future-only range cannot contain a checkout that is already
            // abandoned. Keep the query empty without doing a broad scan.
            $query->whereRaw('1 = 0');
        }

        $carts = $query
            ->orderByDesc('checkout_started_at')
            ->paginate(30)
            ->withQueryString();

        return view('admin.abandoned-carts.index', compact('carts', 'from', 'to'));
    }
}
