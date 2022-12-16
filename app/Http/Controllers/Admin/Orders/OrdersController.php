<?php

namespace App\Http\Controllers\Admin\Orders;

use App\DataTable\Table;
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
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class OrdersController extends Table
{

	public $link = 'orders';

	public function __construct()
	{
		parent::__construct();
	}

	public function builder()
	{
		return Order::query();
	}

	public function index()
	{
		$orders = Order::has('ordered_products')->latest()->orderBy('created_at', 'desc')->paginate(450);
		$orders = $this->getColumnListings(request(), $orders);
		return view('admin.orders.index', compact('orders'));
	}

	public function invoice($id)
	{
		$order = Order::find($id);
		$system_settings = Setting::first();
		$sub_total = $this->subTotal($order);
		return view('admin.orders.invoice', compact('sub_total', 'order', 'system_settings'));
	}

	public function store(Request $request)
	{

		$input = $request->except('_token');
		$input['invoice'] = "INV-" . date('Y') . "-" . rand(10000, 39999);
		$order = new Order;
		$order->fill($input);
		$order->save();

		$total = [];

		foreach ($input['products']['product_name'] as $key => $v) {
			$product =  new OrderedProduct;
			$product->product_name = $v;
			$product->order_id =  $order->id;
			$product->quantity = $input['products']['quantity'][$key];
			$product->item_price = $input['products']['price'][$key];
			$product->tracker = time();
			$product->price = $input['products']['price'][$key];
			$product->total = $input['products']['price'][$key] * $input['products']['quantity'][$key];
			$total[] = $input['products']['price'][$key] * $input['products']['quantity'][$key];
			$product->save();
		}

		$order->total = array_sum($total) + $request->shipping_price;
		$order->save();

		// Send Mail

		return  redirect()->route('admin.orders.index');
	}

	public function routes()
	{
		return [
			'edit' =>  [
				'admin.orders.edit',
				'order'
			],
			'update' => null,
			'show' => null,
			'destroy' =>  [
				'admin.orders.destroy',
				'order'
			],
			'create' => [
				'admin.orders.create'
			],
			'index' => null
		];
	}

	public function unique()
	{
		return [
			'show'  => true,
			'right' => false,
			'edit' => false,
			'search' => true,
			'add' => true,
			'delete' => false,
			'export' => true
		];
	}

	public static function order_status()
	{
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
		$orders = (new OrderedProduct())->getListingData($order->ordered_products()->paginate(10));

		$summaries = [];
		$summaries['Sub-Total'] =  Helper::currencyWrapper($sub_total);
		$summaries['Coupon'] = $order->coupon ? $order->coupon . '  -%' . optional($order->voucher())->amount . 'off'  : '---';
		$summaries['Shipping'] = Helper::currencyWrapper($order->shipping_price);
		$summaries['Heavy Item Charge'] = Helper::currencyWrapper($order->shipping_price);
		$summaries['Total'] = Helper::currencyWrapper($order->total);
		$objs = $this->showData($id);

		return view('admin.orders.show', compact('objs', 'summaries', 'orders', 'statuses', 'order', 'sub_total'));
	}


	public function showData($id)
	{
		$obj =  $this->builder->find($id);

		return [
			'customer' => [
				"Full Name" => optional($obj->user)->fullname(),
				"Phone Number" => optional($obj->user)->phone_number,
				"Email" => optional($obj->user)->email,
				"Date Joined" => optional($obj->user)->created_at->format('d-m-y')
			],
			'Order' => [
				"Date Added" => $obj->created_at,
				"Payment Type" => $obj->payment_type,
				"Shipping" => Helper::currencyWrapper($obj->shipping_price),
			],
		];
	}


	public function create(Request $request)
	{
		return view('admin.orders.create');
	}


	public function subTotal($order)
	{
		$total = DB::table('ordered_products')->select(DB::raw('SUM(ordered_products.price*ordered_products.quantity) as items_total'))->where('order_id', $order->id)->get();
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
			try {
				$order  = Order::find($request->orderId);
				$when   = now()->addMinutes(5);
				\Mail::to($order->user->email)->send(new ReviewMail($request, $order));
			} catch (\Throwable $th) {
				dd($th);
				\Log::info("Mail error :" . $th);
			}
		}
	}


	public function dispatchNote(Request $request, $id)
	{
		$page_title = 'Dispatch Note';
		$order =  Order::find($id);
		return view('admin.dispatch.index', compact('order', 'page_title'));
	}
}
