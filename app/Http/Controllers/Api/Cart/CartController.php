<?php

namespace App\Http\Controllers\Api\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;

use App\Models\Cart;
use App\Models\User;
use App\Models\Setting;
use App\Models\AbandonedCart;


use Storage;
use App\Http\Resources\CartIndexResource;
use App\Http\Resources\CartResource;
use App\Http\Helper;
use App\Models\Attribute;
use App\Models\Engine;
use Illuminate\Support\Facades\Log;

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


		$price = $product->current_price;
		$make = session('make');
		$model = session('model');
		$year = session('year');
		$engine = session('engine');

		$user = $request->user();

		$cookie = null;
		$remember_token = \Cookie::get('cart');

		if ($remember_token === null) {
			$value = bcrypt('^%&#*$((j1a2c3o4b5@+-40');
			session()->put('cart', $value);
			$cookie = cookie('cart', $value, 60 * 60 * 7);
			$remember_token = $cookie->getValue();
		}

		//$engine = optional(Engine::find(session('engine_id')))->name;
		$cart = Cart::query()
			->where('product_id', $request->product_id)
			->where('remember_token', $remember_token)
			->latest('id')
			->first() ?: new Cart;

		$cart->product_id = $request->product_id;
		$cart->quantity = $request->quantity;
		$cart->price = $product->current_price;
		$cart->total = $price * $request->quantity;
		$cart->make = $make;
		$cart->model = $model;
		$cart->referer = session('original_referer');
		$cart->user_id = optional($user)->id;
		$cart->year = $year;
		$cart->engine = $engine;
		$cart->remember_token = $remember_token;
		$cart->save();

		$carts = Cart::all_items_in_cart($remember_token);
		$sub_total = Cart::sum_items_in_cart($remember_token);

		Log::info('cart.store.snapshot', [
			'user_id' => optional($user)->id,
			'cookie' => $remember_token,
			'request' => $request->only(['product_id', 'quantity']),
			'cart_rows' => $carts->map(function ($cart) {
				return [
					'id' => $cart->id,
					'product_id' => $cart->product_id,
					'quantity' => $cart->quantity,
					'price' => $cart->price,
					'total' => $cart->total,
					'remember_token' => $cart->remember_token,
					'user_id' => $cart->user_id,
				];
			})->values()->all(),
			'sub_total' => $sub_total,
		]);

		$cartData = $carts->map(function ($cart) {
			return [
				'id' => $cart->id,
				'cart_id' => $cart->id,
				'product_id' => $cart->product_id,
				'product' => $cart->product,
				'image' => optional($cart->product)->image_m,
				'quantity' => $cart->quantity,
				'price' => Cart::ConvertCurrencyRate($cart->price),
				'currency' => optional($cart->product)->currency,
				'product_name' => optional($cart->product)->name,
				'link' => optional($cart->product)->link,
				'year' => optional($cart)->year,
				'model' => optional($cart)->model,
				'make' => optional($cart)->make,
				'engine' => optional($cart)->engine,
			];
		});

		if (auth()->check()) {
			$cartItems = Cart::all_items_in_cart($remember_token);

			$items = $cartItems->map(function ($cart) {
				return [
					'product_id' => $cart->product_id,
					'name' => $cart->product->name ?? 'Unknown Product',
					'image_url' => $cart->product->image_m ?? '',
					'price' => $cart->product->price ?? 0,
				];
			});

			AbandonedCart::updateOrCreate(
				['user_id' => $user->id],
				['checkout_started_at' => now(), 'recovered' => false, 'cart_items' =>  $items]
			);
		}

		$response = response()->json([
			'data' => $cartData,
			'meta' => [
				'sub_total' => $sub_total,
				'currency' => '₦',
				'currency_code' => '₦',
				'user' => $request->user()
			],
		]);

		return $cookie ? $response->withCookie($cookie) : $response;
	}

	public function loadCart(Request $request)
	{
		if (\Cookie::get('cart') !== null) {
			$remember_token  = \Cookie::get('cart');
		}
		$carts = Cart::all_items_in_cart();
		$sub_total = Cart::sum_items_in_cart();
		$rate = \Cookie::get('rate');
		Log::info('cart.load.snapshot', [
			'user_id' => optional($request->user())->id,
			'cookie' => \Cookie::get('cart'),
			'cart_rows' => $carts->map(function ($cart) {
				return [
					'id' => $cart->id,
					'product_id' => $cart->product_id,
					'quantity' => $cart->quantity,
					'price' => $cart->price,
					'total' => $cart->total,
					'remember_token' => $cart->remember_token,
					'user_id' => $cart->user_id,
				];
			})->values()->all(),
			'sub_total' => $sub_total,
		]);
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

				$user = $request->user();
				if (auth()->check()) {
					$cartItems = Cart::all_items_in_cart();
					$items = $cartItems->map(function ($cart) {
						return [
							'product_id' => $cart->product_id,
						'name' => $cart->product->name ?? 'Unknown Product',
						'image_url' => $cart->product->image_m ?? '',
						'price' => $cart->product->price ?? 0,
					];
				});

				$abandonedCart = AbandonedCart::updateOrCreate(
					['user_id' => $user->id],
					['checkout_started_at' => now(), 'recovered' => false, 'cart_items' =>  $items]
				);

				$carts = Cart::all_items_in_cart();

				if ($carts->isEmpty()) {
					AbandonedCart::where('user_id', $user->id)->delete();
				}
			}



			return $this->loadCart($request);
		}
	}
}
