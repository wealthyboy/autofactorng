<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Cart;

use App\Models\Voucher;

use App\Models\Error;
use App\Models\PendingCart;


use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{

    public  $settings;

    public function __construct()
    {
        $this->settings =  Setting::first();
    }


    public function payment(Request $request)
    {

        try {

            Log::info($request->all());



            $input =  $request->data['metadata']['custom_fields'][0];

            if ($input['type'] == 'order_from_paystack') {

                Log::info($request->all());
                $input    =  $request->data['metadata']['custom_fields'][0];
                $user     =  User::findOrFail($input['customer_id']);
                $carts    =  Cart::find($input['cart']);

                if (null == $carts) {
                    return  http_response_code(200);
                }

                $payment_method = $request->data['authorization']['channel'];
                $ip = $request->data['ip_address'];
                $order = Order::checkout($input, $payment_method,  $ip,  $carts,  $user);

                $admin_emails = explode(',', $this->settings->alert_email);
                $sub_total = Order::subTotal($order);

                Order::getCoupon($order, $sub_total);
                Order::sendMail($user, $order, $sub_total);
                Voucher::inValidate($input['coupon']);

                return http_response_code(200);
            }
        } catch (\Throwable $th) {

            Log::info("Custom error :" . $th);
            Log::info("Custom error :" . $th);
            $err = new Error();
            $err->error = $th->getMessage();
            $err->save();
        }

        return http_response_code(200);
    }

    public function gitHub()
    {
        $output =  shell_exec('sh /var/www/autofactorng.com/deploy.sh');
        return  $output;
    }


    public function zilla(Request $request, Order $order)
    {


        try {
            $data = json_decode($request->data);
            $uuid = $data->clientOrderReference;
            $pending_cart = PendingCart::where('uuid', $uuid)->first();
            $cartIds = explode('|', $pending_cart->cart_ids);
            $user  = User::findOrFail($pending_cart->user_id);
            $carts = Cart::find($cartIds);

            //Log::info($data);
            //Log::info($pending_cart);

            foreach ($carts as $cart) {
                if ($cart->quantity  < 1) {
                    $cart->delete();
                }
            }

            if (null == $carts) {
                return  http_response_code(200);
            }

            $currency = '₦';
            $order->user_id = $user->id;
            $order->address_id = optional($user->active_address)->id;
            $order->coupon = $pending_cart->coupon;
            $order->status = 'Processing';
            $order->shipping_price = $pending_cart->shipping_price;
            $order->invoice = substr(rand(100000, time()), 0, 7);
            $order->heavy_item_price = $pending_cart->heavy_item_price;
            $order->tracking = time();
            $order->order_type = "Online";
            $order->payment_type = 'Zilla';
            $order->total = $pending_cart->total;
            $order->ip = $request->ip();
            $order->first_name = optional($user->active_address)->first_name;
            $order->last_name = optional($user->active_address)->last_name;
            $order->address = optional($user->active_address)->address;
            $order->email = $user->email;
            $order->phone_number = $user->phone_number;
            $order->city = optional($user->active_address)->city;
            $order->state = optional(optional($user->active_address)->address_state)->name;
            $order->country = optional(optional($user->active_address)->address_country)->name;
            //$order = Order::checkout($input, $payment_method,  $ip,  $carts,  $user);
            $order->save();

            foreach ($carts   as $cart) {
                $insert = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_name' => optional($cart->product)->name,
                    'quantity' => $cart->quantity,
                    //'status' => "Processing",
                    'user_id' =>  $user->id,
                    'tracker' => time(),
                    'make' => $cart->make,
                    'model' => $cart->model,
                    'year' => $cart->year,
                    'engine' => $cart->engine,
                    'price' => $cart->ConvertCurrencyRate($cart->price),
                    'total' => $cart->ConvertCurrencyRate($cart->quantity * $cart->price),
                    'created_at' => \Carbon\Carbon::now()
                ];
                OrderedProduct::Insert($insert);
                $cart->delete();
            }

            $sub_total = Order::subTotal($order);

            Order::getCoupon($order, $sub_total);

            Order::sendMail($user, $order, $sub_total);

            Voucher::inValidate($pending_cart->coupon);

            //delete cart

        } catch (\Throwable $th) {
            Log::info("Custom error :" . $th);
            $err = new Error();
            $err->error = $th;
            $err->save();
            // Notification::route('mail', 'jacob.atam@gmail.com')
            //     ->notify(new ErrorNotification($th));
        }

        return http_response_code(200);
    }
}
