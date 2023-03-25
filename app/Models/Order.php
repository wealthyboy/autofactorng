<?php

namespace App\Models;

use App\Http\Helper;
use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
	use HasFactory, ColumnFillable;

	public $appends = ['ship_price'];



	public static $statuses = [
		"Confirmed" => "Confirmed",
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

	public static function checkout($input, $payment_method, $ip, $carts, $user)
	{

		$order = new self;
		$cart  = new Cart();
		$order->user_id = $user->id;
		$order->address_id  = $user->active_address->id;
		$order->coupon = $input['coupon'];
		$order->heavy_item_price = isset($input['heavy_item_price']) ? $input['heavy_item_price'] : null;
		$order->status = 'Confirmed';
		$order->shipping_price  = data_get($input, 'shipping_price');
		$order->invoice =  rand(10000, 3999990);
		$order->payment_type = $payment_method;
		$order->total = $input['total'];
		$order->first_name = optional($user->active_address)->first_name;
		$order->last_name = optional($user->active_address)->last_name;
		$order->email = $user->email;
		$order->tracking =  rand(100000, time());
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
					'product_name' => optional($cart->product)->product_name,
					'quantity' => $cart->quantity,
					'tracker' => time(),
					'price' => $cart->price,
					'total' => $cart->quantity * $cart->price,
					'created_at' => \Carbon\Carbon::now()
				];

				OrderedProduct::Insert($insert);
				$cart->status = 'paid';
				$cart->delete();
			}
		}

		return $order;
	}

	public function shipping()
	{
		return $this->belongsTo(Shipping::class);
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
				return [
					"Id" => $order->id,
					"Invoice" => $order->invoice,
					"Customer" => null !== $order->user ? $order->user->fullname() : $order->fullName(),
					"Email" => $order->email,
					"Status" => array_merge(self::$statuses, ['selected' => $order->status]),
					"Total" => Helper::currencyWrapper($order->total),
					"Date Added" => $order->created_at->format('d-m-y'),
				];
			} else {
				return [
					"Id" => $order->id,
					"Invoice" => $order->invoice,
					"Customer" => null !== $order->user ? $order->user->fullname() : $order->fullName(),
					"Email" => $order->email,
					"Status" => $order->status,
					"Total" => Helper::currencyWrapper($order->total),
					"Date Added" => $order->created_at->format('d-m-y'),
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
