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
use App\Models\Activity;
use App\Models\OrderStatus;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class OrdersController extends Table
{

	public $link = '/admin/orders';

	public $deleted_names = 'name';

	public $deleted_specific = 'locations';

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
		$orders = Order::has('ordered_products')->orderBy('created_at', 'desc')->paginate(150);
		$orders = $this->getColumnListings(request(), $orders);
		return view('admin.orders.index', compact('orders'));
	}

	public function invoice($id)
	{
		$order = Order::find($id);
		$setting = Setting::first();
		return view('admin.orders.invoice', compact('setting', 'order'));
	}

	public function store(Request $request)
	{


		$input = $request->except('_token');
		$input['invoice'] = substr(rand(100000, time()), 0, 10);
		$input['order_type'] = "Offline";
		$input['status'] = "Confirmed";
		$order = new Order;
		$order->fill($input);
		$order->save();
		$total = [];

		foreach ($input['products']['product_name'] as $key => $v) {
			$product =  new OrderedProduct;
			$product->product_name = $v;
			$product->order_id = $order->id;
			$product->quantity = $input['products']['quantity'][$key];
			$product->tracker = rand(100000, time());

			$product->price = $input['products']['price'][$key];
			$product->total = $input['products']['price'][$key] * $input['products']['quantity'][$key];
			$total[] = $input['products']['price'][$key] * $input['products']['quantity'][$key];
			$product->save();
		}

		$total = array_sum($total);
		$shipping = $request->shipping_price;

		if ($request->percentage_type == 'fixed') {
			$new_total = $total - $request->discount;
			$new_total = $new_total +  $shipping;
		}

		if ($request->percentage_type == 'percentage') {
			$new_total = ($request->discount * $total) / 100;
			//dd($new_total);
			$new_total = $total - $new_total;
			$total = $new_total + $shipping;
		}

		$order->total = $total;
		$order->save();

		// Send Mail

		(new Activity)->put("Added a new order with email and phone number  " . $request->email . ' and ' . $request->phone_number);
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
			'export' => true,
			'order' => true
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

	public function edit($id)
	{
		User::canTakeAction(User::canCreate);
		$order = Order::find($id);
		$statuses = static::order_status();
		return view('admin.orders.create', compact('order', 'statuses'));
	}


	public function show($id)
	{

		$order      =  Order::find($id);
		$statuses   =  static::order_status();
		$sub_total  =  $this->subTotal($order);
		$ordered_products = $order->ordered_products()->paginate(10);
		$orders = (new OrderedProduct())->getListingData($ordered_products);

		$summaries = [];
		$summaries['Sub-Total'] =  Helper::currencyWrapper($sub_total);

		if ($order->coupon) {
			$summaries['Discount'] = $order->coupon . '  -%' . optional($order->voucher())->amount . 'off';
		}

		if ($order->discount) {
			$summaries['Discount'] = $order->percentage_type == 'percentage' ? $order->discount . '  % off'  :  '-' . $order->discount;
		}


		$summaries['Shipping'] = Helper::currencyWrapper($order->shipping_price);
		$summaries['Heavy Item Charge'] = Helper::currencyWrapper($order->heavy_item_price);
		$summaries['Total'] = Helper::currencyWrapper($order->total);
		$objs = $this->showData($id);

		return view('admin.orders.show', compact('objs', 'summaries', 'orders', 'statuses', 'order', 'sub_total'));
	}


	public function showData($id)
	{
		$obj =  $this->builder->find($id);

		return [
			'customer' => [
				"Full Name" => null !== $obj->user ?  optional($obj->user)->fullname() :  optional($obj)->fullName(),
				"Phone Number" =>  null !== $obj->user ?  optional($obj->user)->phone_number :  optional($obj)->phone_number,
				"Email" => null !== $obj->user ?  optional($obj->user)->email :  optional($obj)->email,
				"Date Joined" => null !== $obj->user ? optional($obj->user)->created_at->format('d-m-y') :  optional($obj)->created_at->format('d-m-y')
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
		User::canTakeAction(User::canCreate);
		return view('admin.orders.create');
	}


	public function subTotal($order)
	{
		$total = DB::table('ordered_products')->select(DB::raw('SUM(ordered_products.price*ordered_products.quantity) as items_total'))->where('order_id', $order->id)->get();
		return $sub_total = $total[0]->items_total ?? '0.00';
	}

	public function updateStatus(Request $request)
	{
		Order::whereIn('status', ['0'])->delete();

		//status == delivered

		if ($request->value == 'Delivered') {
			$order_statuses = OrderStatus::where('order_id', $request->id)->get();
			if (null !== $order_statuses) {
				foreach ($order_statuses as $order_status) {
					$order_status->is_updated = true;
					$order_status->save();
				}
			}
		}


		if ($request->value == 'Confirmed') {
			$order_statuses = OrderStatus::where('order_id', $request->id)->get();
			if (null !== $order_statuses) {
				foreach ($order_statuses as $order_status) {
					$order_status->is_updated = false;
					$order_status->save();
				}
			}
		}

		if ($request->value == 'Delivered') {
			$order_statuses = OrderStatus::where('order_id', $request->id)->get();
			if (null !== $order_statuses) {
				foreach ($order_statuses as $order_status) {
					$order_status->is_updated = true;
					$order_status->save();
				}
			}

			$order_status = OrderStatus::where(['order_id' => $request->id])->where('status', '=', 'Delivered')->first();

			if (null !== $order_status) {
				$order_status->is_updated = true;
				$order_status->save();
			}

			return response(null, 200);
		}

		if ($request->value == 'Shipped') {
			$order_statuses = OrderStatus::where(['order_id' => $request->id])->where('status', '=', 'Shipped')->where('status', '=', 'Delivered')->get();
			if (null !== $order_statuses) {
				foreach ($order_statuses as $order_status) {
					$order_status->is_updated = true;
					$order_status->save();
				}
			}


			$order_status = OrderStatus::where('order_id', $request->id)->where('status', '=', 'Delivered')->first();

			if (null !== $order_status) {
				$order_status->is_updated = false;
				$order_status->save();
			}

			$order_status = OrderStatus::where(['order_id' => $request->id])->where('status', '=', 'Shipped')->first();

			if (null !== $order_status) {
				$order_status->is_updated = true;
				$order_status->save();
			}

			return response(null, 200);
		}


		if ($request->value == 'Processing') {

			$order_statuses = OrderStatus::where(['order_id' => $request->id])->where('status', '!=', 'Confirmed')->get();
			if (null !== $order_statuses) {
				foreach ($order_statuses as $order_status) {
					$order_status->is_updated = false;
					$order_status->save();
				}
			}


			$order_status = OrderStatus::where(['order_id' => $request->id])->where('status', '=', 'Processing')->first();

			if (null !== $order_status) {
				$order_status->is_updated = true;
				$order_status->save();
			}

			return response(null, 200);
		}




		// $orderStatus = OrderStatus::updateOrCreate(
		// 	['status' =>  request('value'), 'order_id' => request('id')],
		// 	['status' => $request->value, 'is_updated' => 1]
		// );
		// $orderStatus->status = $request->value;
		// $orderStatus->order_id = $request->id;
		// $orderStatus->is_updated = 1;
		// $orderStatus->save();

		$order = Order::find($request->id);
		$order->status =  $request->value;
		$order->save();
		return $order;
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
