<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\Models\AbandonedCart;
use App\Models\UserTracking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MarketingAnalyticsController extends Controller
{
    /**
     * Render only the lightweight page shell. The large tracking queries are
     * requested section-by-section after the page is visible so nginx is not
     * held open by one long analytics request.
     */
    public function index(Request $request)
    {
        [$from, $to] = $this->dateRange($request);

        return view('admin.analytics.marketing', compact('from', 'to'));
    }

    /**
     * Load one marketing analytics section asynchronously.
     */
    public function section(Request $request, string $section)
    {
        $allowed = ['visitors', 'checkout', 'chart', 'sources'];
        abort_unless(in_array($section, $allowed, true), 404);

        [$from, $to] = $this->dateRange($request);
        $cacheKey = sprintf(
            'admin:marketing-analytics:%s:%s:%s:v2',
            $section,
            $from->format('Ymd'),
            $to->format('Ymd')
        );

        $cacheUntil = $section === 'checkout' ? now()->addSeconds(30) : now()->addMinutes(2);

        $data = Cache::remember($cacheKey, $cacheUntil, function () use ($section, $from, $to) {
            switch ($section) {
                case 'visitors':
                    return ['stats' => $this->visitorStats($from, $to)];
                case 'checkout':
                    return ['stats' => $this->checkoutStats($from, $to)];
                case 'chart':
                    return ['chart' => $this->visitorTrend($from, $to)];
                case 'sources':
                    return ['sources' => $this->acquisitionSources($from, $to)];
            }

            return [];
        });

        return response()
            ->view('admin.analytics.marketing_sections.' . $section, $data)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

    private function visitorStats(Carbon $from, Carbon $to): array
    {
        $visits = UserTracking::query()->whereBetween('created_at', [$from, $to]);

        $summary = (clone $visits)
            ->whereNotNull('session_id')
            ->selectRaw('COUNT(DISTINCT session_id) as visitors, AVG(time_spent) as average_time')
            ->first();

        $visitorCount = (int) optional($summary)->visitors;

        $returning = DB::query()->fromSub(
            (clone $visits)
                ->whereNotNull('session_id')
                ->select('session_id')
                ->groupBy('session_id')
                ->havingRaw('COUNT(*) > 1'),
            'returning_sessions'
        )->count();

        return [
            ['label' => 'Website Visitors', 'value' => number_format($visitorCount), 'hint' => 'Unique tracked sessions'],
            ['label' => 'Returning Visitors', 'value' => number_format($returning), 'hint' => 'Sessions with repeat activity'],
            ['label' => 'New Visitors', 'value' => number_format(max($visitorCount - $returning, 0)), 'hint' => 'Single-visit sessions in period'],
            ['label' => 'Average Time', 'value' => $this->duration(optional($summary)->average_time), 'hint' => 'From recorded visit duration'],
        ];
    }

    private function checkoutStats(Carbon $from, Carbon $to): array
    {
        /*
         * A checkout becomes abandoned one hour after checkout_started_at.
         * Report the abandonment in the period in which that one-hour point
         * actually falls, rather than classifying it against the current time
         * and then attaching it to the checkout's original start date.
         *
         * Example: checkout starts Aug 12 at 23:30 and remains unrecovered.
         * It becomes abandoned Aug 13 at 00:30, so it belongs to an Aug 13
         * report, not Aug 12.
         */
        $now = now();
        $effectiveTo = $to->lt($now) ? $to->copy() : $now;

        $abandoned = 0;
        if ($from->lte($effectiveTo)) {
            $abandoned = AbandonedCart::query()
                ->where('recovered', false)
                ->whereNotNull('checkout_started_at')
                ->whereBetween(
                    'checkout_started_at',
                    [
                        $from->copy()->subHour(),
                        $effectiveTo->copy()->subHour(),
                    ]
                )
                ->count();
        }

        // Recovered checkouts continue to be grouped by the checkout attempt's
        // selected period so the existing dashboard meaning is preserved.
        $periodCheckouts = AbandonedCart::query()
            ->whereBetween('checkout_started_at', [$from, $to]);

        $recovered = (clone $periodCheckouts)->where('recovered', true)->count();

        // Active checkouts are only meaningful for a range that reaches the
        // present. Historical ranges should not show old checkouts as active.
        $active = 0;
        if ($to->gte($now)) {
            $active = (clone $periodCheckouts)
                ->where('recovered', false)
                ->where('checkout_started_at', '>', $now->copy()->subHour())
                ->where('checkout_started_at', '<=', $now)
                ->count();
        }

        $resolvedAttempts = $abandoned + $recovered;
        $rate = $resolvedAttempts ? ($abandoned / $resolvedAttempts) * 100 : 0;

        return [
            ['label' => 'Abandoned Carts', 'value' => number_format($abandoned), 'hint' => 'Became abandoned within selected period'],
            ['label' => 'Recovered Checkouts', 'value' => number_format($recovered), 'hint' => 'Checkout attempts that became orders'],
            ['label' => 'Abandoned Cart Rate', 'value' => number_format($rate, 1) . '%', 'hint' => 'Abandoned vs resolved checkout attempts'],
            ['label' => 'Active Checkouts', 'value' => number_format($active), 'hint' => 'Currently active checkouts in selected period'],
        ];
    }

    private function acquisitionSources(Carbon $from, Carbon $to): array
    {
        $sourceExpression = Schema::hasColumn('user_trackings', 'source_channel')
            ? "COALESCE(NULLIF(source_channel, ''), NULLIF(referer, ''), 'Direct / unknown')"
            : "COALESCE(NULLIF(referer, ''), 'Direct / unknown')";

        return UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->whereNotNull('session_id')
            ->selectRaw($sourceExpression . ' as source, COUNT(DISTINCT session_id) as visitors')
            ->groupBy(DB::raw($sourceExpression))
            ->orderByDesc('visitors')
            ->limit(15)
            ->get()
            ->map(function ($source) {
                return [
                    'source' => $source->source,
                    'visitors' => (int) $source->visitors,
                ];
            })
            ->all();
    }

    private function visitorTrend(Carbon $from, Carbon $to): array
    {
        $monthly = $from->diffInDays($to) > 62;
        $bucketSql = $monthly ? "DATE_FORMAT(created_at, '%Y-%m')" : 'DATE(created_at)';

        $sessionRows = UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->whereNotNull('session_id')
            ->selectRaw($bucketSql . ' as bucket, session_id, COUNT(*) as visits')
            ->groupBy('bucket', 'session_id');

        $rows = DB::query()->fromSub($sessionRows, 'marketing_sessions')
            ->selectRaw('bucket, COUNT(*) as visitors, SUM(CASE WHEN visits > 1 THEN 1 ELSE 0 END) as returning_visitors')
            ->groupBy('bucket')
            ->get()
            ->keyBy('bucket');

        $labels = [];
        $visitors = [];
        $returning = [];

        if ($monthly) {
            for ($cursor = $from->copy()->startOfMonth(); $cursor <= $to; $cursor->addMonth()) {
                $row = $rows->get($cursor->format('Y-m'));
                $labels[] = $cursor->format('M Y');
                $visitors[] = $row ? (int) $row->visitors : 0;
                $returning[] = $row ? (int) $row->returning_visitors : 0;
            }
        } else {
            foreach (CarbonPeriod::create($from->copy()->startOfDay(), $to->copy()->startOfDay()) as $day) {
                $row = $rows->get($day->format('Y-m-d'));
                $labels[] = $day->format('d M');
                $visitors[] = $row ? (int) $row->visitors : 0;
                $returning[] = $row ? (int) $row->returning_visitors : 0;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                ['label' => 'Visitors', 'data' => $visitors, 'color' => '#e91e63'],
                ['label' => 'Returning visitors', 'data' => $returning, 'color' => '#344767'],
            ],
        ];
    }

    private function dateRange(Request $request): array
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);

        $to = isset($validated['to']) ? Carbon::parse($validated['to']) : now();
        $from = isset($validated['from']) ? Carbon::parse($validated['from']) : $to->copy()->subDays(29);

        if ($from->diffInDays($to) > 366) {
            $from = $to->copy()->subDays(366);
        }

        return [$from->startOfDay(), $to->endOfDay()];
    }

    private function duration($seconds): string
    {
        $seconds = (int) $seconds;

        return $seconds
            ? sprintf('%dm %02ds', intdiv($seconds, 60), $seconds % 60)
            : 'Not recorded';
    }
}
