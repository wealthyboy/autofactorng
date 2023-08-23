<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Models\BrandCategory;
use App\Models\Error;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\User;
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
        $orders = $orders = array(
            array('order_id' => '438', 'user_id' => '249', 'order_day' => 'Thursday', 'order_date' => '15/09/2016', 'order_time' => '04:51:42 PM', 'payment_method' => 'cash', 'order_type' => 'online', 'order_status' => 'Shipped', 'coupon_id' => '0', 'tracking_number' => NULL, 'total' => NULL, 'discount' => NULL, 'discount_type' => NULL, 'shipping' => NULL),
            array('order_id' => '439', 'user_id' => '249', 'order_day' => 'Friday', 'order_date' => '16/09/2016', 'order_time' => '04:49:30 AM', 'payment_method' => 'cash', 'order_type' => 'online', 'order_status' => 'Shipped', 'coupon_id' => '0', 'tracking_number' => NULL, 'total' => NULL, 'discount' => NULL, 'discount_type' => NULL, 'shipping' => NULL),
            array('order_id' => '440', 'user_id' => '523', 'order_day' => 'Monday', 'order_date' => '19/09/2016', 'order_time' => '03:33:32 PM', 'payment_method' => 'cash', 'order_type' => 'online', 'order_status' => 'Shipped', 'coupon_id' => '0', 'tracking_number' => NULL, 'total' => NULL, 'discount' => NULL, 'discount_type' => NULL, 'shipping' => NULL),
            array('order_id' => '441', 'user_id' => '274', 'order_day' => 'Thursday', 'order_date' => '22/09/2016', 'order_time' => '12:43:11 PM', 'payment_method' => 'cash', 'order_type' => 'online', 'order_status' => 'Shipped', 'coupon_id' => '0', 'tracking_number' => NULL, 'total' => NULL, 'discount' => NULL, 'discount_type' => NULL, 'shipping' => NULL)
        );
        dd(collect($orders)->paginate(2));

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
