<?php

namespace App\Http\Controllers\Api\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;

use App\Models\Cart;
use App\Models\User;
use App\Models\Setting;

use Storage;
use App\Http\Resources\CartIndexResource;
use App\Http\Resources\CartResource;
use App\Http\Helper;
use App\Models\Attribute;
use App\Models\Engine;

class CartController  extends Controller
{

	protected $settings;

	public function __construct()
	{
		$this->settings = Setting::first();
	}


	public function store(Request $request)
	{

		$this->validate($request, [
			'product_id' => 'required|exists:products,id',
			'quantity' => 'required|min:1',
		]);

		$product = Product::find($request->product_id);


		$cart = new Cart;
		if (\Auth::check()) {
			$cart->user_id    = optional($request->user())->id;
		}
		$price = null !== $product->discounted_price ?  $product->discounted_price :  $product->price;
		$make = session('make');
		$model = session('model');
		$year = session('year');
		$engine = session('engine');


		//$engine = optional(Engine::find(session('engine_id')))->name;
		if (\Cookie::get('cart') !== null) {
			$remember_token  = \Cookie::get('cart');
			$cart = Cart::firstOrNew(
				['product_id' => $request->product_id, 'remember_token' => $remember_token]
			);

			$cart->product_id = $request->product_id;
			$cart->quantity = $request->quantity;
			$cart->price = $price;
			$cart->total = $price * $request->quantity;
			$cart->make = $make;
			$cart->model = $model;
			$cart->user_id    = optional($request->user())->id;
			$cart->year = $year;
			$cart->engine = $engine;
			$cart->save();



			$carts = Cart::with(["product"])->where(['remember_token' => $remember_token])->get();
			$total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('remember_token', $remember_token)->get();
			$sub_total =  $total[0]->items_total;

			$cart = $carts->map(function ($cart) {
				return [
					'id' => $cart->id,
					'product_id' => $cart->product_id,
					'product' => $cart->product,
					'image' => optional($cart->product)->image_tn,
					'quantity' => $cart->quantity,
					'price' => Cart::ConvertCurrencyRate($cart->price),
					'currency' => optional($cart->product)->currency,
					'product_name' => optional($cart->product)->name,
					'link' => optional($cart->product)->link,
					'year' => optional($cart)->year,
					'model' => optional($cart)->model,

				];
			});


			return response()->json([
				'data' => $cart,
				'meta' => [
					'sub_total' => $sub_total,
					'currency' => '₦',
					'currency_code' => '₦',
					'user' => $request->user()
				],
			]);
		} else {
			$value = bcrypt('^%&#*$((j1a2c3o4b5@+-40');
			session()->put('cart', $value);
			$cookie = cookie('cart', session()->get('cart'), 60 * 60 * 7);
			$cart->product_id = $request->product_id;
			$cart->quantity = $request->quantity;
			$cart->price = $price;
			$cart->total = $price * $request->quantity;
			$cart->remember_token = $cookie->getValue();
			$cart->make = $make;
			$cart->model = $model;
			$cart->year = $year;
			$cart->engine = $engine;
			$cart->user_id = optional($request->user())->id;
			$cart->save();
			$carts = Cart::all_items_in_cart();
			$total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('remember_token', $cookie->getValue())->get();
			$sub_total =  $total[0]->items_total;

			return response()->json([
				'data' => [

					0 => [
						'cart_id' => $cart->id,
						'product_id' => $cart->product_id,
						'image' => optional($cart->product)->image_m,
						'quantity' => $cart->quantity,
						'price' => $cart->price,
						'product_name' => optional($cart->product)->name,
						'link' => optional($cart->product)->name,
						'make' => $make,
						'model' => $model,
						'year' => $year,
						'engine' => $engine

					]
				],
				'meta' => [
					'sub_total' => $sub_total,
					'currency' => '₦',
					'currency_code' => '₦',
					'user' => $request->user()
				],
			])->withCookie($cookie);
		}
	}

	public function loadCart(Request $request)
	{

		$carts = Cart::all_items_in_cart();
		$sub_total = Cart::sum_items_in_cart();
		$rate = \Cookie::get('rate');
		return  CartIndexResource::collection($carts)->additional([
			'meta' => [
				'sub_total' => $sub_total,
				'currency' => '₦',
				'currency_code' => '₦',
				'user' => $request->user(),
				'isAdmin' => null !== $request->user() ? $request->user()->isAdmin() : false
			],
		]);
	}

	public function destroy(Request $request, $cart_id)
	{

		if ($request->ajax()) {
			$cart =  Cart::find($cart_id);
			if (null !== $cart) {
				$cart->delete();
			}
			return $this->loadCart($request);
		}
	}
}
