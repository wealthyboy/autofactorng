<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\Models\CategorySearch;
use App\Models\UserTracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SearchAnalyticsController extends Controller
{
    /**
     * Render only the analytics shell. Heavy report sections are loaded
     * independently after the page is visible so one slow query cannot hold
     * the complete admin request open until nginx times out.
     */
    public function index(Request $request)
    {
        [$from, $to] = $this->dateRange($request);

        return view('admin.analytics.search', compact('from', 'to'));
    }

    /**
     * Return one search-analytics section for the AJAX loader.
     */
    public function section(Request $request, string $section)
    {
        $allowed = ['summary', 'terms', 'products', 'categories'];
        abort_unless(in_array($section, $allowed, true), 404);

        [$from, $to] = $this->dateRange($request);
        $cacheKey = sprintf(
            'admin:search-analytics:%s:%s:%s',
            $section,
            $from->format('Ymd'),
            $to->format('Ymd')
        );

        // Analytics does not need to hit the tracking tables repeatedly when
        // an admin refreshes the page. Two minutes keeps it effectively live
        // while protecting the database from repeated heavy reads.
        $data = Cache::remember($cacheKey, now()->addMinutes(2), function () use ($section, $from, $to) {
            switch ($section) {
                case 'summary':
                    return ['stats' => $this->summaryStats($from, $to)];
                case 'terms':
                    return ['terms' => $this->topTerms($from, $to)];
                case 'products':
                    return ['products' => $this->topProducts($from, $to)];
                case 'categories':
                    return ['categories' => $this->topCategories($from, $to)];
            }

            return [];
        });

        return response()
            ->view('admin.analytics.search_sections.' . $section, $data)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }

    private function summaryStats(Carbon $from, Carbon $to): array
    {
        $searchBase = $this->searchTrackingQuery($from, $to);
        $termExpression = $this->searchTermExpression();

        $searchCount = (clone $searchBase)->count();
        $uniqueTerms = (int) (clone $searchBase)
            ->where('page_url', 'like', '%q=%')
            ->selectRaw("COUNT(DISTINCT {$termExpression}) as total")
            ->value('total');

        $productViews = UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->whereNotNull('product_id')
            ->count();

        return [
            ['label' => 'Searches', 'value' => number_format($searchCount), 'hint' => 'Tracked search page visits'],
            ['label' => 'Unique terms', 'value' => number_format($uniqueTerms), 'hint' => 'Distinct recorded queries'],
            ['label' => 'Product views', 'value' => number_format($productViews), 'hint' => 'Tracked product visits'],
            ['label' => 'No-result searches', 'value' => 'Not recorded', 'hint' => 'Requires result-count tracking'],
        ];
    }

    private function topTerms(Carbon $from, Carbon $to): array
    {
        $termExpression = $this->searchTermExpression();

        // The previous implementation loaded every matching tracking row into
        // PHP and then parsed it. On a large user_trackings table that can
        // exhaust the request time/memory. Aggregate in MySQL first and only
        // return the highest-frequency terms to PHP.
        $rows = $this->searchTrackingQuery($from, $to)
            ->where('page_url', 'like', '%q=%')
            ->selectRaw("{$termExpression} as term, COUNT(*) as total")
            ->groupBy(DB::raw($termExpression))
            ->orderByDesc('total')
            ->limit(100)
            ->get();

        $terms = [];
        foreach ($rows as $row) {
            $term = trim((string) urldecode((string) $row->term));
            $term = preg_replace('/\s+/', ' ', $term);

            if ($term === '') {
                continue;
            }

            $terms[$term] = ($terms[$term] ?? 0) + (int) $row->total;
        }

        arsort($terms);

        return array_slice($terms, 0, 20, true);
    }

    private function topProducts(Carbon $from, Carbon $to): array
    {
        return UserTracking::query()
            ->join('products', 'products.id', '=', 'user_trackings.product_id')
            ->whereBetween('user_trackings.created_at', [$from, $to])
            ->select('products.name')
            ->selectRaw('COUNT(*) as views')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('views')
            ->limit(15)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'views' => (int) $product->views,
                ];
            })
            ->all();
    }

    private function topCategories(Carbon $from, Carbon $to): array
    {
        return CategorySearch::query()
            ->whereBetween('created_at', [$from, $to])
            ->select('name')
            ->selectRaw('COUNT(*) as visits')
            ->groupBy('name')
            ->orderByDesc('visits')
            ->limit(15)
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'visits' => (int) $category->visits,
                ];
            })
            ->all();
    }

    private function searchTrackingQuery(Carbon $from, Carbon $to)
    {
        return UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->where('page_url', 'like', '%/search%');
    }

    /**
     * Extract q= from a tracked full URL. AutofactorNG stores fullUrl() in
     * user_trackings.page_url, so this keeps the existing analytics meaning
     * while avoiding a get() of every matching row.
     */
    private function searchTermExpression(): string
    {
        return "NULLIF(TRIM(REPLACE(SUBSTRING_INDEX(SUBSTRING_INDEX(page_url, 'q=', -1), '&', 1), '+', ' ')), '')";
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
}
