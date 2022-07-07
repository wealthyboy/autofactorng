<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\User;
use App\Models\SystemSetting;
use App\Models\OrderedProduct;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusNotification;
use App\Mail\ReviewMail;






class OrdersController extends Controller{ 


  
    public function __construct()
    {
       //$this->middleware('admin'); 
	  // $this->settings =  \DB::table('system_settings')->first();
    }

    public function index ( ) { 
	
		$orders = Order::has('ordered_products')->orderBy('created_at','desc')->paginate(450);
        return view('admin.orders.index',compact('orders'));
    }
    

    public function invoice($id){
        $order     =  Order::find($id);
        $system_settings = Setting::first();
		$sub_total = $this->subTotal($order);
        return view('admin.orders.invoice',compact('sub_total','order','system_settings'));
    }

    public static function order_status() { 
		return [
			"Processing",
			"Refunded",
			"Shipped",
			"Delivered"
		];
	}

	public function show($id) 
	{ 
	   $order      =  Order::find($id);
	   $statuses   =  static::order_status();
	   $sub_total  =  $this->subTotal($order);
	   return view('admin.orders.show',compact('statuses','order','sub_total'));
	}


	public function create(Request $request) 
	{ 
	  
	   return view('admin.orders.create');
	}


	public function subTotal($order)
	{
		$total = \Db::table('ordered_product')->select(\DB::raw('SUM(ordered_product.price*ordered_product.quantity) as items_total'))->where('order_id',$order->id)->get();
        return $sub_total = $total[0]->items_total ?? '0.00';
	}
	
	public function updateStatus(Request $request)
	{
		$ordered_product = OrderedProduct::findOrFail($request->ordered_product_id);
		$ordered_product->status = $request->status;
		$ordered_product->save();  
		return $ordered_product;
	}
	
	
	public function updateOrderStatus(Request $request)
	{
		if ($request->message_type == 1) {
            $user = User::find($request->id);
	    	Notification::route('mail', $user->email)
            ->notify(new OrderStatusNotification($user, $request));
		} else {
            try{
				$order  = Order::find($request->orderId);
				$when   = now()->addMinutes(5);
				\Mail::to($order->user->email)->send(new ReviewMail($request, $order));
			} catch (\Throwable $th) {
				dd($th);
				\Log::info("Mail error :".$th);
			}
		}
	}


    public function dispatchNote(Request $request,$id){
	    $page_title = 'Dispatch Note';
		$order =  Order::find($id);	 
		return view('admin.dispatch.index',compact('order','page_title'));
	}


}