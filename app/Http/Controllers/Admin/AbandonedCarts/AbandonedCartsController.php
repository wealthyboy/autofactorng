<?php

namespace App\Http\Controllers\Admin\AbandonedCarts;

use App\Http\Controllers\Controller;
use App\Models\AbandonedCart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbandonedCartsController extends Controller
{
    /**
     * Show checkout attempts that actually crossed the one-hour abandonment
     * threshold during the selected period. A later order does not remove the
     * attempt from this history; it is shown as Recovered instead.
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

        $baseQuery = AbandonedCart::query()
            ->with(['user:id,name,last_name,email,phone_number'])
            ->whereNotNull('checkout_started_at');

        if ($from->lte($effectiveTo)) {
            $baseQuery
                ->whereBetween('checkout_started_at', [
                    $from->copy()->subHour(),
                    $effectiveTo->copy()->subHour(),
                ])
                ->where(function ($query) {
                    // Unrecovered carts are abandoned once the one-hour point
                    // is crossed. Recovered carts stay in the historical list
                    // only when recovery happened after that point.
                    $query->where('recovered', false)
                        ->orWhereNull('recovered_at')
                        ->orWhereRaw('recovered_at >= DATE_ADD(checkout_started_at, INTERVAL 1 HOUR)');
                });
        } else {
            $baseQuery->whereRaw('1 = 0');
        }

        $totalAbandoned = (clone $baseQuery)->count();
        $recoveredCount = (clone $baseQuery)->where('recovered', true)->count();
        $unrecoveredCount = max($totalAbandoned - $recoveredCount, 0);

        $carts = (clone $baseQuery)
            ->orderByDesc('checkout_started_at')
            ->paginate(30)
            ->withQueryString();

        return view('admin.abandoned-carts.index', compact(
            'carts',
            'from',
            'to',
            'totalAbandoned',
            'recoveredCount',
            'unrecoveredCount'
        ));
    }
}
