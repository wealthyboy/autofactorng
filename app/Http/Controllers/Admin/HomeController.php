<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
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
        // Order::truncate();
        // OrderedProduct::truncate();
        $top_selling_product = OrderedProduct::select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->whereMonth('created_at', date('m'))
            ->with('product')
            ->first();

        $stats = [];
        $stats['sales'] = 0;
        $stats['Customers'] = (new User())->customers()->count();
        // $stats['top_sells'] = 0;

        return view('admin.index', compact('stats'));
    }
}
