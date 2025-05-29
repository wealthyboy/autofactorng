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
use App\Mail\OrderReceipt;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusNotification;
use App\Mail\ReviewMail;
use App\Models\Activity;
use App\Models\Error;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
		$sub_total = $this->subTotal($order);
		$ordered_products = $order->ordered_products()->paginate(20);
		$ordered_products = (new OrderedProduct())->getListingData($ordered_products);
		$summaries = [];
		$summaries['Sub-Total'] = Helper::currencyWrapper($sub_total);
		$summaries['Discount'] = '';

		if ($order->coupon) {
			$summaries['Discount'] = '-₦' . number_format((optional($order->voucher())->amount / 100) * $sub_total);
		}

		if ($order->discount) {
			if ($order->percentage_type == 'percentage') {
				$summaries['Discount'] =  '-₦' . number_format(($order->discount / 100) * $sub_total);
			} else {
				$summaries['Discount'] = number_format($order->discount);
			}
		}

		$no_card = true;
		$summaries['Shipping'] = Helper::currencyWrapper($order->shipping_price);
		$summaries['Heavy Item Charge'] = Helper::currencyWrapper($order->heavy_item_price);
		$summaries['Total'] = Helper::currencyWrapper($order->total);
		$objs = $this->showData($id);
		return view('admin.orders.invoice', compact('no_card', 'summaries', 'objs', 'sub_total', 'setting', 'order', 'ordered_products'));
	}



	public function store(Request $request)
	{

		//try {
		//DB::beginTransaction();

		$email = explode(',', $request->email);
		$user = User::where('email', $email[0])->first();
		$input = $request->except('_token');
		$input['invoice'] = substr(rand(100000, time()), 0, 7);
		$input['order_type'] = "Offline";
		$input['user_id'] = null !== $user ? $user->id : null;
		$input['status'] = "Confirmed";
		$order = new Order;
		$order->fill($input);
		$order->save();
		foreach (Order::$statuses as $key => $status) {
			$order_status = new OrderStatus();
			$order_status->is_updated = false;
			$order_status->status = $status;
			$order_status->order_id = $order->id;
			$order_status->save();
		}

		$order_status = OrderStatus::where(['status' => 'Confirmed', 'order_id' => $order->id])->first();

		if (null !== $order_status) {
			$order_status->is_updated = true;
			$order_status->save();
		}

		$total = [];

		foreach ($input['products']['product_name'] as $key => $v) {
			$OrderedProduct =  new OrderedProduct;
			$OrderedProduct->product_name = $v;
			$OrderedProduct->order_id = $order->id;
			$OrderedProduct->quantity = $input['products']['quantity'][$key];
			$OrderedProduct->tracker = rand(100000, time());
			$OrderedProduct->price = $input['products']['price'][$key];
			$OrderedProduct->total = $input['products']['price'][$key] * $input['products']['quantity'][$key];
			$total[] = $input['products']['price'][$key] * $input['products']['quantity'][$key];
			$OrderedProduct->save();



			$product = Product::where('product_name', $input['products']['product_name'][$key])->first();

			if (null !== $product && $product->quantity > 1) {
				$newQuantity = $product->quantity - $input['products']['quantity'][$key];
				$product->quantity = $newQuantity > 0 ?  $newQuantity : 0;
				$product->save();
			}
		}

		$sub_total = array_sum($total);
		$shipping = $request->shipping_price;
		$heavy_or_large_item = $request->heavy_item_price;
		if ($request->percentage_type == 'fixed') {
			$new_total = $sub_total - $request->discount;
			$total = $new_total + $shipping;
			$total = $total + $heavy_or_large_item;
		}


		if ($request->filled('percentage_type') && !$request->filled('discount')) {
			dd("Please enter a discount");
		}


		if ($request->percentage_type == 'percentage') {
			$new_total = ($request->discount * $sub_total) / 100;
			$new_total = $sub_total - $new_total;
			$total = $new_total + $shipping;
			$total = $total + $heavy_or_large_item;
		}

		if (!$request->filled('percentage_type')) {
			$total =  array_sum($total) + $shipping  + $heavy_or_large_item;
		}

		//dd($total);

		$order->total = is_array($total) ? array_sum($total)  : $total;
		$order->save();


		$order->heavy_item_price = $request->heavy_item_price ?? '---';

		if ($order->coupon) {
			$order->coupon_value = '-₦' . number_format(
				(optional($order->voucher())->amount / 100) * $sub_total
			);
			$order->coupon = optional($order->voucher())->amount . '% Discount';
		} else {
			if ($order->discount) {
				if ($order->percentage_type == 'percentage') {
					$order->coupon = $order->discount . '% Discount';
					$order->coupon_value = '-' . number_format(($order->discount  / 100) * $sub_total);
				} else {
					$order->coupon = 'Discount';
					$order->coupon_value = '-' . number_format($order->discount);
				}
			} else {
				$order->coupon = 'Coupon';
				$order->coupon_value = '----';
			}
		}

		//dd($order);

		//try {
		$user = User::find(1);
		$when = now()->addMinutes(5);
		$order->full_name = $request->first_name;
		Mail::to($request->email)
			->bcc('order@autofactorng.com')
			->send(new OrderReceipt($order, null, null, $sub_total));
		//	} catch (\Throwable $th) {
		// Log::info("Mail error :" . $th);
		// Log::info("Custom error :" . $th);
		// $err = new Error();
		// $err->error = $th->getMessage();
		// $err->save();
		//}

		// Send Mail
		(new Activity)->put("Added a new order with email and phone number  " . $request->email . ' and ' . $request->phone_number);

		//DB::commit();
		return  redirect()->route('admin.orders.index');
		//} catch (\Throwable $th) {
		//DB::rollBack();
		return  redirect()->route('admin.orders.index')->with('errors', 'Something went wrong');
		//}
	}

	public function routes()
	{
		return [
			'edit' =>  [
				'admin.orders.edit',
				'order'
			],
			'update' => null,
			'show' =>  [
				'admin.orders.show',
				'order'
			],
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
			'show' => true,
			'right' => false,
			'edit' => false,
			'search' => true,
			'add' => true,
			'delete' => false,
			'destroy' => true,
			'export' => true,
			'order' => true,
			'export_name' => 'OrdersExport',
			'show_checkbox' => true
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

		$order = Order::find($id);
		$statuses = static::order_status();
		$sub_total = $this->subTotal($order);
		$ordered_products = $order->ordered_products()->paginate(200);
		$orders = (new OrderedProduct())->getListingData($ordered_products);
		$summaries = [];
		$summaries['Sub-Total'] =  Helper::currencyWrapper($sub_total);

		if ($order->coupon) {
			$summaries[optional($order->voucher())->amount . ' % Discount'] =  '-₦' . number_format((optional($order->voucher())->amount / 100) * $sub_total);
		}

		if ($order->discount) {
			$summaries['Discount'] = $order->percentage_type == 'percentage' ? $order->discount . '  % off'  :  '-' . $order->discount;
		}

		$summaries['Shipping'] = Helper::currencyWrapper($order->shipping_price);
		$summaries['Heavy Item Charge'] = Helper::currencyWrapper($order->heavy_item_price);
		$summaries['Total'] = Helper::currencyWrapper($order->total);
		$objs = $this->showData($id);
		$no_card = false;

		return view('admin.orders.show', compact('objs', 'no_card', 'summaries', 'orders', 'statuses', 'order', 'sub_total'));
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


		if ($request->value === 'Cancelled') {
			$order = Order::find($request->id);
			$order->is_cancelled = true;
			$order->status = $request->value;
			$order->save();
			return response()->json($order, 200);
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
		}

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

			$order_status = OrderStatus::where(['order_id' => $request->id])->where('status', '=', 'Confirmed')->first();
			if (null !== $order_status) {
				$order_status->is_updated = true;
				$order_status->save();
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
		}

		if ($request->value == 'Shipped') {
			$order_statuses = OrderStatus::where(['order_id' => $request->id])->where('status', '!=', 'Delivered')->get();
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
		if ($request->column == 'Dispatch') {
			$order->dispatch =  $request->value;
		}

		if ($request->column == 'Status') {
			$order->status =  $request->value;
			$order->is_cancelled = false;
		}

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
				$order = Order::find($request->orderId);
				$when = now()->addMinutes(5);
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
