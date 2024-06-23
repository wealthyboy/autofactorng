<?php

namespace App\Models;

use App\Http\Helper;
use App\Jobs\ReviewProduct;
use App\Mail\OrderReceipt;
use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ProductReviewNotification;

class Order extends Model
{
	use HasFactory, ColumnFillable;

	public $appends = ['ship_price'];

	public static $statuses = [
		"Confirmed" => "Confirmed",
		"Cancelled" => "Cancelled",
		"Processing" => "Processing",
		"Shipped" => "Shipped",
		"Delivered" => "Delivered",
	];

	public function ordered_products()
	{
		return $this->hasMany(OrderedProduct::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function address()
	{
		return $this->belongsTo(Address::class);
	}

	public static function orderReviewNotiication($order)
	{
		return null;
	}

	public static function checkout($input, $payment_method, $ip, $carts, $user)
	{

		$order = new self;
		$cart  = new Cart();

		$order->user_id = $user->id;
		$order->address_id = $user->active_address->id;
		$order->coupon = $input['coupon'];
		$order->heavy_item_price = isset($input['heavy_item_price']) ? $input['heavy_item_price'] : null;
		$order->status = 'Confirmed';
		$order->shipping_price = data_get($input, 'shipping_price');
		$order->invoice = substr(rand(100000, time()), 0, 7);
		$order->payment_type = $payment_method;
		$order->allow_review = 1;
		$order->total = $input['total'];
		$order->first_name = optional($user->active_address)->first_name;
		$order->last_name = optional($user->active_address)->last_name;
		$order->email = $user->email;
		$order->tracking = rand(100000, time());
		$order->order_type = "Online";
		$order->phone_number = $user->phone_number;
		$order->address = optional($user->active_address)->address;
		$order->city = optional($user->active_address)->city;
		$order->state = optional(optional($user->active_address)->address_state)->name;
		$order->ip = $ip;

		if ($order->save()) {

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


			foreach ($carts   as $cart) {

				$insert = [
					'order_id' => $order->id,
					'product_id' => $cart->product_id,
					'product_name' => optional($cart->product)->name,
					'quantity' => $cart->quantity,
					'tracker' => time(),
					'price' => $cart->price,
					'total' => $cart->quantity * $cart->price,
					'make' => $cart->make,
					'model' => $cart->model,
					'year' => $cart->year,
					'engine' => $cart->engine,
					'created_at' => \Carbon\Carbon::now()
				];

				OrderedProduct::Insert($insert);
				$cart->status = 'paid';
				$cart->delete();
			}
		}
		try {
			$delay = now()->addMinutes(10);
		} catch (\Throwable $th) {
			throw $th;
		}

		return $order;
	}


	public static function sendMail(User $user, Order $order, $sub_total)
	{

		try {
			$when = now()->addMinutes(5);
			Mail::to($user->email)
				->bcc('order@autofactorng.com')
				->send(new OrderReceipt($order, null, null, $sub_total));
		} catch (\Throwable $th) {
			Log::info("Mail error :" . $th);
			$err = new Error();
			$err->error = $th->getMessage();
			$err->save();
		}
	}

	public static function getCoupon(Order $order, $sub_total)
	{
		if ($order->coupon) {
			$order->coupon_value = '-₦' . number_format(
				(optional($order->voucher())->amount / 100) * $sub_total
			);
			$order->coupon = optional($order->voucher())->amount . '% Discount';
		} else {
			$order->coupon = 'Discount';
			$order->coupon_value = '----';
		}

		$order->currency = '₦';
		$order->heavy_item_price = $order->heavy_item_price ?? 0;
	}


	public static function subTotal(Order $order)
	{
		$total =  DB::table('ordered_products')->select(DB::raw('SUM(ordered_products.price*ordered_products.quantity) as items_total'))->where('order_id', $order->id)->get();
		return $sub_total = $total[0]->items_total ?? '0.00';
	}

	public function shipping()
	{
		return $this->belongsTo(Shipping::class);
	}


	public function orderEmail()
	{
		return $this->hasOne(OrderEmail::class);
	}

	public function getShipPriceAttribute()
	{
		return  $this->shipping_price ?? optional($this->shipping)->converted_price;
	}


	public static function getShowData(Order $order)
	{
		return [];
	}

	public function getListingData($collection)
	{

		return  $collection->map(function ($order) {
			if (str_contains(request()->path(), 'admin')) {
				$d =  $this->dispatch();
				if (($key = array_search($order->dispatch, $this->dispatch())) !== false) {
					unset($this->dispatch()[$key]);
					$d = array_diff($this->dispatch(), array($order->dispatch));
				}

				if (null !== $order->orderEmail) {
					return [
						"Id" => $order->id,
						"Invoice" => $order->invoice,
						"Customer" => optional($order->orderEmail)->fullname,
						"Email" => optional($order->orderEmail)->email,
						"Payment Type" =>  $order->payment,
						"Type" => 'offline',
						"Status" => array_merge(self::$statuses, ['selected' => $order->status]),
						"Dispatch" => array_merge($d, ['selected' => $order->dispatch ?? 'Select dispatch']),
						"Total" => Helper::currencyWrapper($order->total),
						"Date" => $order->created_at->format('d-m-y'),
					];
				}
				return [
					"Id" => $order->id,
					"Invoice" => $order->invoice,
					"Customer" => null !== $order->user ? $order->user->fullname() : $order->fullName(),
					"Email" => $order->email,
					"Payment Type" => $order->payment_type,
					"Type" => $order->order_type,
					"Dispatch" => array_merge($d, ['selected' => $order->dispatch ?? 'Select Dispatch']),
					"Status" => array_merge(self::$statuses, ['selected' => $order->status]),
					"Total" => Helper::currencyWrapper($order->total),
					"Date" => $order->created_at->format('d-m-y'),
				];
			} else {
				return [
					"Invoice" => $order->invoice,
					"Status" => $order->status,
					"Total" => Helper::currencyWrapper($order->total),
					"Date " => $order->created_at->format('d-m-y'),
				];
			}
		});
	}

	public function sortKeys($key)
	{
		$sort =  [
			"Id" => 'id',
			"Invoice" => 'invoice',
			"Customer" => 'first_name',
			"Email" => 'email',
			"Total" =>  'total',
			"Date Added" => 'created_at',
		];

		return $sort[$key];
	}

	public function selected($collection)
	{
		return  $collection->map(function ($order) {
			return [
				"Status" => $this->status,
			];
		});
	}

	public  function order_statuses()
	{
		return $this->hasMany(OrderStatus::class);
	}

	public  function dispatch()
	{
		return [
			'New Dispatch',
			'Henry',
			'Emem',
			'WayBill',
			'Ext Dispatch',
			'Pick Up'
		];
	}




	public  function fullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public  function voucher()
	{
		$voucher = Voucher::where('code', $this->coupon)->first();

		if (null !== $voucher) {
			return $voucher;
		}

		return false;
	}


	public function getCouponDiscount($amount)
	{
		if ($this->voucher()) {
			return	Helper::getPercentageDiscount($this->voucher()->amount, $amount);
		}
		return;
	}


	public static function all_sales($id = null)
	{
		if ($id) {
			$total = static::select(\DB::raw('SUM(orders.total) as items_total'))->where('order_id', $id)->get();
			return 	$total = $total[0];
		} else {
			$total = static::select(\DB::raw('SUM(orders.total) as items_total'))->get();
			return 	$total = $total[0];
		}
	}


	public function get_total()
	{
		if ($this->order_type == 'admin') {
			return number_format($this->total);
		}
		return number_format($this->total);
	}


	public  function shipfullname()
	{
		return ucfirst($this->ship_name) . ' ' . ucfirst($this->ship_last_name);
	}
}
