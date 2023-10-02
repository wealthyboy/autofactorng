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


        $path = public_path('images/prodcts');
        $files = File::allFiles($path);
        //dd($files);

        $top_selling_product = OrderedProduct::select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->whereMonth('created_at', date('m'))
            ->with('product')
            ->first();

        $stats = [];
        $stats['Orders'] = Order::count();
        $stats['Customers'] = (new User())->customers()->count();
        $statistics['activities'] = Activity::latest()->paginate(10);



        $top_product = OrderedProduct::select('product_name')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('product_name')
            ->orderByDesc('count')
            ->limit(1)
            ->first();
        dd($top_product);
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
}
