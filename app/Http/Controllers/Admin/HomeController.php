<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Models\Activity;
use App\Models\BrandCategory;
use Illuminate\Support\Facades\DB;

use App\Models\Error;
use App\Models\Image;
use App\Models\Imgae;
use App\Models\Order;
use App\Models\OrderEmail;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\Wallet;
use App\Models\WalletBalance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;






class HomeController extends Controller
{
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);
        $to = isset($validated['to']) ? Carbon::parse($validated['to'])->endOfDay() : now()->endOfDay();
        $from = isset($validated['from']) ? Carbon::parse($validated['from'])->startOfDay() : $to->copy()->subDays(29)->startOfDay();
        if ($from->diffInDays($to) > 366) {
            $from = $to->copy()->subDays(366)->startOfDay();
        }

        $validOrders = Order::whereBetween('created_at', [$from, $to])->where('status', '!=', 'Cancelled');
        $newCustomerOrders = (clone $validOrders)->whereNotNull('email')->whereNotExists(function ($query) use ($from) {
            $query->select(DB::raw(1))->from('orders as previous_orders')
                ->whereColumn('previous_orders.email', 'orders.email')
                ->where('previous_orders.created_at', '<', $from);
        })->count();

        $stats = [];
        $stats['Orders'] = (clone $validOrders)->count();
        $stats['Customers'] = User::customers()->whereBetween('created_at', [$from, $to])->count();
        $stats['New Customers'] = $newCustomerOrders;
        $stats['Return Customers'] = max($stats['Orders'] - $newCustomerOrders, 0);
        $statistics['activities'] = Activity::whereBetween('created_at', [$from, $to])->latest()->paginate(10)->withQueryString();

        $top_product = OrderedProduct::query()->join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->whereBetween('orders.created_at', [$from, $to])->where('orders.status', '!=', 'Cancelled')
            ->select('ordered_products.product_name')
            ->selectRaw('SUM(ordered_products.quantity) AS count')
            ->groupBy('product_name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $statistics['top_product'] = $top_product;

        $top_price = OrderedProduct::whereBetween('created_at', [$from, $to])->select('price')
            ->groupBy('price')
            ->orderByRaw('COUNT(*) DESC')
            // ->whereMonth('created_at', now()->)
            ->with('product')
            ->first();
        $statistics['top_price'] = $top_price;

        $orders = Order::whereBetween('created_at', [$from, $to])->latest()->paginate(5)->withQueryString();
        $statistics['top_price'] = $top_price;
        $statistics['orders'] = $orders;

        $topBuyers = Order::whereBetween('created_at', [$from, $to])->where('status', '!=', 'Cancelled')->select('first_name', 'email')
            ->selectRaw('COUNT(*) as order_count')
            ->groupBy('first_name', 'email')
            ->orderByDesc('order_count')
            ->limit(15)
            ->get();
        $statistics['top_buyers'] = $topBuyers;

        $trendRows = Order::whereBetween('created_at', [$from, $to])
            ->where('status', '!=', 'Cancelled')
            ->selectRaw('DATE(created_at) as day, COUNT(*) as orders, SUM(total) as revenue')
            ->groupBy('day')->orderBy('day')->get()->keyBy('day');
        $statistics['order_trend'] = ['labels' => [], 'orders' => [], 'revenue' => []];
        foreach (CarbonPeriod::create($from->copy()->startOfDay(), $to->copy()->startOfDay()) as $day) {
            $key = $day->format('Y-m-d');
            $row = $trendRows->get($key);
            $statistics['order_trend']['labels'][] = $day->format('d M');
            $statistics['order_trend']['orders'][] = $row ? (int) $row->orders : 0;
            $statistics['order_trend']['revenue'][] = $row ? (float) $row->revenue : 0;
        }





        // $stats['top_sells'] = 0;

        return view('admin.index', compact('stats', 'statistics', 'from', 'to'));
    }

    public function getSingleEmailOrders()
    {


        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $newCustomersCount = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('orders as o2')
                    ->whereColumn('o2.email', 'orders.email')
                    ->where('o2.created_at', '<', Carbon::now()->startOfMonth());
            })
            ->distinct('email')
            ->count('email');




        return $newCustomersCount;
    }
}
