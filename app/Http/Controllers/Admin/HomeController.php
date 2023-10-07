<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Models\Activity;
use App\Models\BrandCategory;
use App\Models\Error;
use App\Models\Order;
use App\Models\OrderEmail;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\Wallet;
use App\Models\WalletBalance;
use Carbon\Carbon;
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
        //$this->middleware('admin'); 
    }

    public function index(Request $request)
    {
        // $products =  $products =  Product::whereHas('categories', function ($query) use ($request) {
        //     $query->where('categories.slug', 'spare-parts-suspension-parts');

        // })->orderBy('created_at', 'desc')->get();
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);




        $top_selling_product = OrderedProduct::has('order')->select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->whereMonth('created_at', date('m'))
            ->with('product')
            ->first();

        $stats = [];
        $stats['Orders'] = Order::whereMonth('created_at', date('m'))->count();
        $stats['Customers'] = (new User())->customers()->count();
        $stats['New Customers'] = Order::whereMonth('created_at', date('m'))->select('email')
            ->groupBy('email')
            ->selectRaw('COUNT(email) as user_count')
            ->having('user_count', '=', 1)
            ->get();

        //$stats['Return Customers'] = // $stats['Orders'] - $stats['New Customers']; null;

        dd($this->getSingleEmailOrdersForThisMonth());

        $statistics['activities'] = Activity::latest()->paginate(10);



        $top_product = OrderedProduct::has('order')->select('product_name')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('product_name')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $statistics['top_product'] = $top_product;

        $top_price = OrderedProduct::select('price')
            ->groupBy('price')
            ->orderByRaw('COUNT(*) DESC')
            // ->whereMonth('created_at', now()->)
            ->with('product')
            ->first();
        $statistics['top_price'] = $top_price;

        $orders = Order::latest()->paginate(5);
        $statistics['top_price'] = $top_price;
        $statistics['orders'] = $orders;




        // $stats['top_sells'] = 0;

        return view('admin.index', compact('stats', 'statistics'));
    }

    public function getSingleEmailOrdersForThisMonth()
    {
        $singleEmails = \DB::table('orders')
            ->select('email')
            ->where(DB::raw('MONTH(order_date)'), '=', Carbon::now()->month)
            ->where(DB::raw('YEAR(order_date)'), '=', Carbon::now()->year)
            ->groupBy('email')
            ->havingRaw('COUNT(email) = 1')
            ->pluck('email');

        $orders = Order::whereIn('email', $singleEmails)
            ->where(DB::raw('MONTH(order_date)'), '=', Carbon::now()->month)
            ->where(DB::raw('YEAR(order_date)'), '=', Carbon::now()->year)
            ->get();

        return $orders;
    }
}
