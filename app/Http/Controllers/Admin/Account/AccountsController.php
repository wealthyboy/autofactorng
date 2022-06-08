<?php

namespace App\Http\Controllers\Admin\Account;

use Illuminate\Http\Request;
use App\Http\Helper;

use App\Models\Product;
use App\Models\OrderedProduct;
use App\Models\Order;
use App\Models\ProductSize;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Setting;




use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AccountsController extends Controller 
{
    
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 

        //
       // User::canTakeAction(1);

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        // if($request->has('from_date')){
        //     $graph_orders = OrderedProduct::select('id', 'created_at')
        //     ->get()
        //     ->groupBy(function($date) {
        //         return Carbon::parse($date->created_at)->format('m'); // grouping by months
        //     });

        //     $from_date =  Helper::getDate($request->from_date).' 00:00:00'; 
        //     $to_date =  Helper::getDate($request->to_date).' 23:59:59';  
        //     $ordered_products =  \DB::select('SELECT * FROM `ordered_product` WHERE created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $ordered_products = OrderedProduct::hydrate($ordered_products);

        //     $no_of_products_left =  \DB::select('SELECT SUM(product_sizes.quantity) as items_total FROM `product_sizes`  WHERE price is not null  AND created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $no_of_products_left=  ProductSize::hydrate($no_of_products_left)[0]->items_total;

        //     $total_sales =  \DB::select('SELECT SUM(orders.total) as items_total FROM `orders` WHERE created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $total_sales = Order::hydrate($total_sales)[0];
        //     $p_total =  \DB::select('SELECT SUM(product_sizes.price*product_sizes.quantity) as items_total FROM `product_sizes` WHERE  price is not null  AND created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $p_total =  ProductSize::hydrate($p_total)[0];
        //     return view('admin.account.index',compact(
        //         'no_of_products_left',
        //         'no_of_products',
        //         'ordered_products',
        //         'total_sales',
        //         'graph_orders' ,
        //         'p_total'
        //     ));
        // }
        // // $graph_orders = OrderedProduct::select('id', 'created_at')
        // // ->get()
        // // ->groupBy(function($date) {
        // //     return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // // });

        // $todays_orders       = OrderedProduct::select(\DB::raw('SUM(quantity) as qty'))
        //                          ->whereDate('created_at', Carbon::today())->get();
        // $todays_sales        = Order::select(\DB::raw('SUM(total) as items_total'))
        //                       ->whereDate('created_at', Carbon::today())->get();
        // // $todays_sales_w_s  = Order::select(\DB::raw('SUM(shipping_price) as items_total'))
        // //                  ->whereDate('created_at', Carbon::today())->get();
        // $todays_sales_s      = Order::select(\DB::raw('SUM(shipping_price) as price'))
        //                  ->whereDate('created_at', Carbon::today())->get();
        // $currency            = $this->settings->default_currency->symbol;
        // $todays_sales        = null !== $todays_sales ? $todays_sales[0] : null;
        // $todays_sales_s      = null !== $todays_sales_s ? $todays_sales_s[0] : null;
        // $todays_orders       = null !== $todays_orders ? $todays_orders[0] : null;
        // $all_sales_value = Order::select(\DB::raw('SUM(total) as items_total'))->get();
        // $all_sales_value = null !== $all_sales_value ? $all_sales_value[0] : null;
        // $all_sales = OrderedProduct::select(\DB::raw('SUM(quantity) as qty'))->get();
        // $all_sales = null !== $all_sales ? $all_sales[0] : null;
        // $amount = ProductVariation::select(\DB::raw('sum(price * quantity) as total'))->get();
    
        // $total_value = null !== $amount ? $amount[0] : null;

        // $tows = $todays_sales->items_total - $todays_sales_s->price;
        // //products quantities left
        // $remaining_products =  ProductVariation::sum('quantity');

        // $product_variation= OrderedProduct::select('product_variation_id')
        // ->groupBy('product_variation_id')
        // ->orderByRaw('COUNT(*) DESC')
        // ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        // ->with('product_variation')
        // ->first();


        // $product_variation_month = OrderedProduct::select('product_variation_id')
        // ->groupBy('product_variation_id')
        // ->orderByRaw('COUNT(*) DESC')
        // ->whereMonth('created_at', date('m'))        
        // ->with('product_variation')
        // ->first();

        // return view('admin.account.index',compact(
        //     'todays_orders',
        //     'todays_sales',
        //     'currency',
        //     'total_value',
        //     'all_sales_value',
        //     'all_sales',
        //     'remaining_products',
        //     'tows',
        //     'product_variation',
        //     'product_variation_month'
        // ));

        return view('admin.account.index');

    
    }

   

   


  
}
