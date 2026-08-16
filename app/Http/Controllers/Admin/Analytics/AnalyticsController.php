<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\AbandonedCart;
use App\Models\CategorySearch;
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
                ->where('quantity', '<=', 5)->orderBy('quantity')->orderBy('name')->limit(15)->get(),
            'slowProducts' => Product::select('products.id', 'products.name', 'products.sku')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))->from('ordered_products')
                        ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
                        ->whereColumn('ordered_products.product_id', 'products.id')
                        ->where('orders.status', '!=', 'Cancelled')
                        ->where('orders.created_at', '>=', now()->subDays(60));
                })->limit(15)->get(),
            'fastProducts' => OrderedProduct::query()->join('orders', 'orders.id', '=', 'ordered_products.order_id')
                ->where('orders.status', '!=', 'Cancelled')->where('orders.created_at', '>=', now()->startOfMonth())
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
        $days = max($from->diffInDays($to), 1);
        $previousFrom = $from->copy()->subDays($days + 1);
        $previousTo = $from->copy()->subSecond();
        $newCustomers = User::customers()->whereBetween('created_at', [$from, $to])->count();
        $previousCustomers = User::customers()->whereBetween('created_at', [$previousFrom, $previousTo])->count();
        $growth = $previousCustomers ? (($newCustomers - $previousCustomers) / $previousCustomers) * 100 : ($newCustomers ? 100 : 0);

        return view('admin.analytics.customers', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Total customers', 'value' => number_format(User::customers()->count()), 'hint' => 'All registered customers'],
                ['label' => 'New customers', 'value' => number_format($newCustomers), 'hint' => 'Joined in selected period'],
                ['label' => 'Customer growth', 'value' => number_format($growth, 1) . '%', 'hint' => 'Against previous equal period'],
                ['label' => 'Customers who ordered', 'value' => number_format(Order::whereBetween('created_at', [$from, $to])->whereNotNull('user_id')->distinct()->count('user_id')), 'hint' => 'Unique registered buyers'],
            ],
            'chart' => $this->monthlyCustomerTrend($to),
            'topCustomers' => Order::query()
                ->where('status', '!=', 'Cancelled')
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
                ['label' => 'Recently reached zero', 'value' => number_format(Product::where('quantity', '<=', 0)->whereBetween('updated_at', [$from, $to])->count()), 'hint' => 'Zero-stock products updated in period'],
            ],
            'outOfStock' => Product::select('id', 'name', 'sku', 'quantity', 'updated_at')->where('quantity', '<=', 0)->latest('updated_at')->limit(20)->get(),
            'recentlySold' => (clone $soldItems)->selectRaw("COALESCE(NULLIF(ordered_products.product_name, ''), 'Unnamed product') as name")
                ->selectRaw('SUM(ordered_products.quantity) as units')->groupBy('name')->orderByDesc('units')->limit(15)->get(),
        ]);
    }

    public function marketing(Request $request)
    {
        [$from, $to] = $this->dateRange($request);
        $visits = UserTracking::whereBetween('created_at', [$from, $to]);
        $visitorCount = (clone $visits)->whereNotNull('session_id')->distinct()->count('session_id');
        $returning = DB::query()->fromSub((clone $visits)->whereNotNull('session_id')->select('session_id')
            ->groupBy('session_id')->havingRaw('COUNT(*) > 1'), 'returning_sessions')->count();
        $abandoned = AbandonedCart::whereBetween('checkout_started_at', [$from, $to])->where('recovered', false)->count();
        $orders = Order::whereBetween('created_at', [$from, $to])->count();

        return view('admin.analytics.marketing', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Website visitors', 'value' => number_format($visitorCount), 'hint' => 'Unique tracked sessions'],
                ['label' => 'Abandoned cart rate', 'value' => number_format(($abandoned + $orders) ? $abandoned / ($abandoned + $orders) * 100 : 0, 1) . '%', 'hint' => 'Abandoned checkouts vs carts resolved'],
                ['label' => 'Returning visitors', 'value' => number_format($returning), 'hint' => 'Sessions with repeat visits'],
                ['label' => 'New visitors', 'value' => number_format(max($visitorCount - $returning, 0)), 'hint' => 'Single-visit sessions in period'],
                ['label' => 'Average time', 'value' => $this->duration((clone $visits)->whereNotNull('time_spent')->avg('time_spent')), 'hint' => 'From recorded visit duration'],
            ],
            'chart' => $this->monthlyVisitorTrend($to),
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
        $searches = UserTracking::whereBetween('created_at', [$from, $to])->where('page_url', 'like', '%/search%')->get(['page_url']);
        $terms = $searches->map(function ($visit) {
            parse_str((string) parse_url($visit->page_url, PHP_URL_QUERY), $query);
            return trim((string) ($query['q'] ?? ''));
        })->filter()->countBy()->sortDesc()->take(20);

        return view('admin.analytics.search', [
            'from' => $from,
            'to' => $to,
            'stats' => [
                ['label' => 'Searches', 'value' => number_format($searches->count()), 'hint' => 'Tracked search page visits'],
                ['label' => 'Unique terms', 'value' => number_format($terms->count()), 'hint' => 'Distinct recorded queries'],
                ['label' => 'Product views', 'value' => number_format(UserTracking::whereBetween('created_at', [$from, $to])->whereNotNull('product_id')->count()), 'hint' => 'Tracked product visits'],
                ['label' => 'No-result searches', 'value' => 'Not recorded', 'hint' => 'Requires result-count tracking'],
            ],
            'terms' => $terms,
            'products' => UserTracking::query()->join('products', 'products.id', '=', 'user_trackings.product_id')
                ->whereBetween('user_trackings.created_at', [$from, $to])->select('products.name')->selectRaw('COUNT(*) as views')
                ->groupBy('products.id', 'products.name')->orderByDesc('views')->limit(15)->get(),
            'categories' => CategorySearch::query()->whereBetween('created_at', [$from, $to])->select('name')->selectRaw('COUNT(*) as visits')
                ->groupBy('name')->orderByDesc('visits')->limit(15)->get(),
        ]);
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

    private function monthlyCustomerTrend(Carbon $to): array
    {
        $labels = $new = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = $to->copy()->subMonths($i);
            $labels[] = $month->format('M Y');
            $new[] = User::customers()->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])->count();
        }
        return ['labels' => $labels, 'datasets' => [['label' => 'New customers', 'data' => $new, 'color' => '#e91e63']]];
    }

    private function monthlyVisitorTrend(Carbon $to): array
    {
        $labels = $visitors = $returning = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = $to->copy()->subMonths($i);
            $query = UserTracking::whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()]);
            $labels[] = $month->format('M Y');
            $visitors[] = (clone $query)->distinct()->count('session_id');
            $returning[] = (clone $query)->whereNotNull('user_id')->distinct()->count('user_id');
        }
        return ['labels' => $labels, 'datasets' => [
            ['label' => 'Visitors', 'data' => $visitors, 'color' => '#e91e63'],
            ['label' => 'Returning visitors', 'data' => $returning, 'color' => '#344767'],
        ]];
    }
}
