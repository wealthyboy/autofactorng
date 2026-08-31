<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\AbandonedCart;
use App\Models\Category;
use App\Models\User;
use App\Models\UserTracking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AnalyticsController extends Controller
{
    public function orders(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $orders = $this->ordersQuery($from, $to);
        $validOrders = (clone $orders)->where('status', '!=', 'Cancelled');

        $orderCount = (clone $orders)->count();
        $validOrderCount = (clone $validOrders)->count();
        $revenue = (float) (clone $validOrders)->sum('total');
        $newCustomerOrders = (clone $validOrders)->whereNotNull('user_id')->whereNotExists(function ($query) use ($from) {
            $query->select(DB::raw(1))->from('orders as previous_orders')
                ->whereColumn('previous_orders.user_id', 'orders.user_id')
                ->where('previous_orders.created_at', '<', $from);
        })->count();

        return view('admin.analytics.orders', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Orders', 'value' => number_format($orderCount), 'hint' => 'All orders in period'],
                ['label' => 'Revenue', 'value' => $this->money($revenue), 'hint' => 'Excludes cancelled orders'],
                ['label' => 'Average order', 'value' => $this->money($validOrderCount ? $revenue / $validOrderCount : 0), 'hint' => 'Revenue per valid order'],
                ['label' => 'Delivered', 'value' => number_format((clone $orders)->where('status', 'Delivered')->count()), 'hint' => 'Completed orders'],
                ['label' => 'Pending', 'value' => number_format((clone $orders)->whereNotIn('status', ['Delivered', 'Cancelled'])->count()), 'hint' => 'Awaiting completion'],
                ['label' => 'New-customer orders', 'value' => number_format($newCustomerOrders), 'hint' => 'Buyer had no earlier order'],
                ['label' => 'Returning-customer orders', 'value' => number_format(max($validOrderCount - $newCustomerOrders, 0)), 'hint' => 'Valid orders from existing buyers'],
            ],
            'trend' => $this->orderTrend($validOrders, $from, $to),
            'statuses' => (clone $orders)->select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')->orderByDesc('total')->get(),
            'channels' => (clone $orders)->selectRaw("COALESCE(NULLIF(order_from, ''), 'Direct / unknown') as label, COUNT(*) as total")
                ->groupBy('label')->orderByDesc('total')->limit(10)->get(),
        ]);
    }

    public function products(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $items = OrderedProduct::query()
            ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->whereBetween('orders.created_at', [$from->copy()->startOfDay(), $to->copy()->endOfDay()])
            ->where('orders.status', '!=', 'Cancelled');

        $units = (int) (clone $items)->sum('ordered_products.quantity');
        $sales = (float) (clone $items)->sum('ordered_products.total');

        return view('admin.analytics.products', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Units sold', 'value' => number_format($units), 'hint' => 'Excludes cancelled orders'],
                ['label' => 'Product sales', 'value' => $this->money($sales), 'hint' => 'Line-item revenue'],
                ['label' => 'Average unit value', 'value' => $this->money($units ? $sales / $units : 0), 'hint' => 'Sales divided by units'],
                ['label' => 'Low stock', 'value' => number_format(Product::where('quantity', '<=', 5)->count()), 'hint' => 'Five units or fewer'],
            ],
            'topProducts' => (clone $items)
                ->selectRaw("COALESCE(NULLIF(ordered_products.product_name, ''), 'Unnamed product') as name")
                ->selectRaw('SUM(ordered_products.quantity) as units, SUM(ordered_products.total) as sales')
                ->groupBy('name')->orderByDesc('units')->limit(15)->get(),
            'lowStock' => Product::select('id', 'name', 'sku', 'quantity')
                ->where('quantity', '<=', 5)->whereBetween('updated_at', [$from, $to])
                ->orderBy('quantity')->orderBy('name')->limit(15)->get(),
            'slowProducts' => Product::select('products.id', 'products.name', 'products.sku')
                ->where('products.created_at', '<=', $to)
                ->whereNotExists(function ($query) use ($from, $to) {
                    $query->select(DB::raw(1))->from('ordered_products')
                        ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
                        ->where(function ($match) {
                            $match->whereColumn('ordered_products.product_id', 'products.id')
                                ->orWhere(function ($legacyMatch) {
                                    $legacyMatch->whereNull('ordered_products.product_id')
                                        ->whereColumn('ordered_products.product_name', 'products.name');
                                });
                        })
                        ->where('orders.status', '!=', 'Cancelled')
                        ->whereBetween('orders.created_at', [$from, $to]);
                })
                ->orderBy('products.name')
                ->limit(15)->get(),
            'fastProducts' => OrderedProduct::query()->join('orders', 'orders.id', '=', 'ordered_products.order_id')
                ->where('orders.status', '!=', 'Cancelled')->whereBetween('orders.created_at', [$from, $to])
                ->selectRaw("COALESCE(NULLIF(ordered_products.product_name, ''), 'Unnamed product') as name")
                ->selectRaw('SUM(ordered_products.quantity) as units')->groupBy('name')
                ->havingRaw('SUM(ordered_products.quantity) > 5')->orderByDesc('units')->limit(15)->get(),
        ]);
    }

    public function all(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $orders = $this->ordersQuery($from, $to);
        $validOrders = (clone $orders)->where('status', '!=', 'Cancelled');
        $orderCount = (clone $validOrders)->count();
        $revenue = (float) (clone $validOrders)->sum('total');
        $customers = (clone $validOrders)->whereNotNull('user_id')->distinct('user_id')->count('user_id');

        return view('admin.analytics.all', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Revenue', 'value' => $this->money($revenue), 'hint' => 'Excludes cancelled orders'],
                ['label' => 'Orders', 'value' => number_format($orderCount), 'hint' => 'Valid orders'],
                ['label' => 'Customers', 'value' => number_format($customers), 'hint' => 'Unique registered buyers'],
                ['label' => 'Average order', 'value' => $this->money($orderCount ? $revenue / $orderCount : 0), 'hint' => 'Revenue per order'],
            ],
            'trend' => $this->orderTrend($validOrders, $from, $to),
            'recentOrders' => (clone $orders)->latest('created_at')->limit(10)->get(),
            'topProducts' => OrderedProduct::query()
                ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
                ->whereBetween('orders.created_at', [$from->copy()->startOfDay(), $to->copy()->endOfDay()])
                ->where('orders.status', '!=', 'Cancelled')
                ->selectRaw("COALESCE(NULLIF(ordered_products.product_name, ''), 'Unnamed product') as name")
                ->selectRaw('SUM(ordered_products.quantity) as units, SUM(ordered_products.total) as sales')
                ->groupBy('name')->orderByDesc('sales')->limit(10)->get(),
        ]);
    }

    public function customers(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $newCustomers = User::customers()->whereBetween('created_at', [$from, $to])->count();
        $totalCustomers = User::customers()->where('created_at', '<=', $to)->count();
        $growth = $totalCustomers ? ($newCustomers / $totalCustomers) * 100 : 0;

        return view('admin.analytics.customers', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Total customers', 'value' => number_format($totalCustomers), 'hint' => 'Registered by end of period'],
                ['label' => 'New customers', 'value' => number_format($newCustomers), 'hint' => 'Joined in selected period'],
                ['label' => 'Customer growth', 'value' => number_format($growth, 1) . '%', 'hint' => 'New customers as a share of total customers'],
                ['label' => 'Customers who ordered', 'value' => number_format(Order::whereBetween('created_at', [$from, $to])->whereNotNull('user_id')->distinct()->count('user_id')), 'hint' => 'Unique registered buyers'],
            ],
            'chart' => $this->customerTrend($from, $to),
            'topCustomers' => Order::query()
                ->whereBetween('created_at', [$from, $to])->where('status', '!=', 'Cancelled')
                ->selectRaw("COALESCE(NULLIF(email, ''), CONCAT('Customer #', user_id)) as customer")
                ->selectRaw('COUNT(*) as orders, SUM(total) as spent')
                ->groupBy('customer')->orderByDesc('spent')->limit(15)->get(),
        ]);
    }

    public function inventory(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $soldItems = OrderedProduct::query()->join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->whereBetween('orders.created_at', [$from, $to])->where('orders.status', '!=', 'Cancelled');

        return view('admin.analytics.inventory', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Total stock value', 'value' => $this->money(Product::selectRaw('SUM(quantity * price) as value')->value('value')), 'hint' => 'Current quantity × selling price'],
                ['label' => 'Out of stock', 'value' => number_format(Product::where('quantity', '<=', 0)->count()), 'hint' => 'Products with no quantity'],
                ['label' => 'Inventory sold', 'value' => number_format((clone $soldItems)->sum('ordered_products.quantity')), 'hint' => 'Units sold in selected period'],
                ['label' => 'Items with 1 remaining', 'value' => number_format(Product::where('quantity', 1)->count()), 'hint' => 'Products with exactly one unit left'],
            ],
            'oneRemaining' => Product::select('id', 'name', 'sku', 'quantity')
                ->where('quantity', 1)
                ->orderBy('name')->limit(20)->get(),
            'recentlySold' => (clone $soldItems)->selectRaw("COALESCE(NULLIF(ordered_products.product_name, ''), 'Unnamed product') as name")
                ->selectRaw('SUM(ordered_products.quantity) as units')->groupBy('name')->orderByDesc('units')->limit(15)->get(),
        ]);
    }

    public function marketing(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $visits = UserTracking::whereBetween('created_at', [$from, $to]);
        $visitSummary = (clone $visits)->selectRaw('COUNT(DISTINCT session_id) as visitors, AVG(time_spent) as average_time')->first();
        $visitorCount = (int) $visitSummary->visitors;
        $returning = DB::query()->fromSub((clone $visits)->whereNotNull('session_id')->select('session_id')
            ->groupBy('session_id')->havingRaw('COUNT(*) > 1'), 'returning_sessions')->count();
        $abandoned = AbandonedCart::whereBetween('checkout_started_at', [$from, $to])->where('recovered', false)->count();

        return view('admin.analytics.marketing', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Website visitors', 'value' => number_format($visitorCount), 'hint' => 'Unique tracked sessions'],
                ['label' => 'Abandoned carts', 'value' => number_format($abandoned), 'hint' => 'Unrecovered checkouts in selected period'],
                ['label' => 'Returning visitors', 'value' => number_format($returning), 'hint' => 'Sessions with repeat visits'],
                ['label' => 'New visitors', 'value' => number_format(max($visitorCount - $returning, 0)), 'hint' => 'Single-visit sessions in period'],
                ['label' => 'Average time', 'value' => $this->duration($visitSummary->average_time), 'hint' => 'From recorded visit duration'],
            ],
            'chart' => $this->visitorTrend($from, $to),
            'sources' => (clone $visits)->selectRaw(
                (Schema::hasColumn('user_trackings', 'source_channel')
                    ? "COALESCE(NULLIF(source_channel, ''), NULLIF(referer, ''), 'Direct / unknown')"
                    : "COALESCE(NULLIF(referer, ''), 'Direct / unknown')")
                . ' as source, COUNT(DISTINCT session_id) as visitors'
            )
                ->groupBy('source')->orderByDesc('visitors')->limit(15)->get(),
        ]);
    }

    public function search(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $searchRows = UserTracking::whereBetween('created_at', [$from, $to])
            ->where('page_url', 'like', '%/search%')
            ->select('page_url', 'action')
            ->selectRaw('COUNT(*) as visits')
            ->groupBy('page_url', 'action')
            ->get();

        $termCounts = collect();
        foreach ($searchRows as $row) {
            parse_str((string) parse_url($row->page_url, PHP_URL_QUERY), $query);
            $term = trim((string) ($query['q'] ?? ''));

            if ($term === '') {
                continue;
            }

            $termCounts->put($term, (int) $termCounts->get($term, 0) + (int) $row->visits);
        }

        $termCounts = $termCounts->sortDesc();
        $productViews = $this->productViewAnalytics($from, $to);
        $categoryViews = $this->categoryViewAnalytics($from, $to);
        $searchCount = (int) $searchRows->sum('visits');
        $noResultSearches = (int) $searchRows->where('action', 'search_no_results')->sum('visits');

        return view('admin.analytics.search', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Searches', 'value' => number_format($searchCount), 'hint' => 'Tracked search page visits'],
                ['label' => 'Unique terms', 'value' => number_format($termCounts->count()), 'hint' => 'Distinct recorded queries'],
                ['label' => 'Product views', 'value' => number_format($productViews->sum('views')), 'hint' => 'Tracked product detail views'],
                ['label' => 'No-result searches', 'value' => number_format($noResultSearches), 'hint' => 'Searches that returned no products'],
            ],
            'terms' => $termCounts->take(20),
            'products' => $productViews->take(15),
            'categories' => $categoryViews->take(15),
        ]);
    }

    private function productViewAnalytics(Carbon $from, Carbon $to)
    {
        $directRows = UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->whereNotNull('product_id')
            ->select('product_id')
            ->selectRaw('COUNT(*) as views')
            ->groupBy('product_id')
            ->get();

        $legacyRows = UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->whereNull('product_id')
            ->where('page_url', 'like', '%/product/%')
            ->select('page_url')
            ->selectRaw('COUNT(*) as views')
            ->groupBy('page_url')
            ->get();

        $productIds = $directRows->pluck('product_id')->filter()->unique()->values();
        $productSlugs = $legacyRows->map(function ($row) {
            return $this->lastPathSegment($row->page_url);
        })->filter()->unique()->values();

        if ($productIds->isEmpty() && $productSlugs->isEmpty()) {
            return collect();
        }

        $products = Product::query()
            ->where(function ($query) use ($productIds, $productSlugs) {
                if ($productIds->isNotEmpty()) {
                    $query->whereIn('id', $productIds);
                }

                if ($productSlugs->isNotEmpty()) {
                    $method = $productIds->isNotEmpty() ? 'orWhereIn' : 'whereIn';
                    $query->{$method}('slug', $productSlugs);
                }
            })
            ->get(['id', 'name', 'slug']);

        $productsById = $products->keyBy('id');
        $productsBySlug = $products->keyBy('slug');
        $counts = [];

        foreach ($directRows as $row) {
            $product = $productsById->get((int) $row->product_id);

            if (! $product) {
                continue;
            }

            $counts[$product->id] = (object) [
                'id' => $product->id,
                'name' => $product->name,
                'views' => (int) $row->views,
            ];
        }

        foreach ($legacyRows as $row) {
            $product = $productsBySlug->get($this->lastPathSegment($row->page_url));

            if (! $product) {
                continue;
            }

            if (! isset($counts[$product->id])) {
                $counts[$product->id] = (object) [
                    'id' => $product->id,
                    'name' => $product->name,
                    'views' => 0,
                ];
            }

            $counts[$product->id]->views += (int) $row->views;
        }

        return collect($counts)->sortByDesc('views')->values();
    }

    private function categoryViewAnalytics(Carbon $from, Carbon $to)
    {
        $rows = UserTracking::query()
            ->whereBetween('created_at', [$from, $to])
            ->where('page_url', 'like', '%/products/%')
            ->select('page_url')
            ->selectRaw('COUNT(*) as visits')
            ->groupBy('page_url')
            ->get();

        $slugs = $rows->map(function ($row) {
            return $this->lastPathSegment($row->page_url);
        })->filter()->unique()->values();

        if ($slugs->isEmpty()) {
            return collect();
        }

        $categories = Category::whereIn('slug', $slugs)->get(['id', 'name', 'slug'])->keyBy('slug');
        $counts = [];

        foreach ($rows as $row) {
            $category = $categories->get($this->lastPathSegment($row->page_url));

            if (! $category) {
                continue;
            }

            if (! isset($counts[$category->id])) {
                $counts[$category->id] = (object) [
                    'id' => $category->id,
                    'name' => $category->name,
                    'visits' => 0,
                ];
            }

            $counts[$category->id]->visits += (int) $row->visits;
        }

        return collect($counts)->sortByDesc('visits')->values();
    }

    private function lastPathSegment($url): string
    {
        $path = trim((string) parse_url((string) $url, PHP_URL_PATH), '/');

        if ($path === '') {
            return '';
        }

        $segments = explode('/', $path);

        return urldecode((string) end($segments));
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

    private function ordersQuery(Carbon $from, Carbon $to): Builder
    {
        return Order::query()->whereBetween('created_at', [$from, $to]);
    }

    private function orderTrend(Builder $query, Carbon $from, Carbon $to): array
    {
        $rows = (clone $query)->selectRaw('DATE(created_at) as day, COUNT(*) as orders, SUM(total) as revenue')
            ->groupBy('day')->orderBy('day')->get()->keyBy('day');

        $labels = [];
        $orders = [];
        $revenue = [];
        foreach (CarbonPeriod::create($from->copy()->startOfDay(), $to->copy()->startOfDay()) as $day) {
            $key = $day->format('Y-m-d');
            $row = $rows->get($key);
            $labels[] = $day->format('d M');
            $orders[] = $row ? (int) $row->orders : 0;
            $revenue[] = $row ? (float) $row->revenue : 0;
        }

        return compact('labels', 'orders', 'revenue');
    }

    private function money($amount): string
    {
        return '₦' . number_format((float) $amount, 2);
    }

    private function duration($seconds): string
    {
        $seconds = (int) $seconds;
        return $seconds ? sprintf('%dm %02ds', intdiv($seconds, 60), $seconds % 60) : 'Not recorded';
    }

    private function customerTrend(Carbon $from, Carbon $to): array
    {
        $monthly = $from->diffInDays($to) > 62;
        $bucketSql = $monthly ? "DATE_FORMAT(created_at, '%Y-%m')" : 'DATE(created_at)';
        $rows = User::customers()->whereBetween('created_at', [$from, $to])
            ->selectRaw($bucketSql . ' as bucket, COUNT(*) as total')
            ->groupBy('bucket')->get()->keyBy('bucket');
        $labels = $new = [];

        if ($monthly) {
            for ($cursor = $from->copy()->startOfMonth(); $cursor <= $to; $cursor->addMonth()) {
                $key = $cursor->format('Y-m');
                $labels[] = $cursor->format('M Y');
                $new[] = (int) optional($rows->get($key))->total;
            }
        } else {
            foreach (CarbonPeriod::create($from->copy()->startOfDay(), $to->copy()->startOfDay()) as $day) {
                $key = $day->format('Y-m-d');
                $labels[] = $day->format('d M');
                $new[] = (int) optional($rows->get($key))->total;
            }
        }

        return ['labels' => $labels, 'datasets' => [['label' => 'New customers', 'data' => $new, 'color' => '#e91e63']]];
    }

    private function visitorTrend(Carbon $from, Carbon $to): array
    {
        $monthly = $from->diffInDays($to) > 62;
        $bucketSql = $monthly ? "DATE_FORMAT(created_at, '%Y-%m')" : 'DATE(created_at)';
        $sessionRows = UserTracking::whereBetween('created_at', [$from, $to])
            ->whereNotNull('session_id')
            ->selectRaw($bucketSql . ' as bucket, session_id, COUNT(*) as visits')
            ->groupBy('bucket', 'session_id');
        $rows = DB::query()->fromSub($sessionRows, 'monthly_sessions')
            ->selectRaw('bucket, COUNT(*) as visitors, SUM(CASE WHEN visits > 1 THEN 1 ELSE 0 END) as returning_visitors')
            ->groupBy('bucket')->get()->keyBy('bucket');

        $labels = $visitors = $returning = [];
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
        return ['labels' => $labels, 'datasets' => [
            ['label' => 'Visitors', 'data' => $visitors, 'color' => '#e91e63'],
            ['label' => 'Returning visitors', 'data' => $returning, 'color' => '#344767'],
        ]];
    }
}
