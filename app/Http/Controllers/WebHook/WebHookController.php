<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Cart;
use App\Models\Currency;
use App\Models\Shipping;
use App\Models\ProductVariation;
use App\Models\Voucher;
use App\Models\Wallet;
use App\Models\WalletBalance;
use App\Mail\OrderReceipt;
use App\Models\Error;
use App\Models\PendingCart;
use App\Models\Product;
// use App\Mail\SendGiftCard;

// use App\Jobs\ReviewProduct;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

            \Log::info($request->all());

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
                $total =  DB::table('ordered_products')->select(DB::raw('SUM(ordered_products.price*ordered_products.quantity) as items_total'))->where('order_id', $order->id)->get();
                $sub_total = $total[0]->items_total ?? '0.00';
                $order->currency = '₦';

                if ($order->coupon) {
                    $order->coupon_value = '-₦' . number_format(
                        (optional($order->voucher())->amount / 100) * $sub_total
                    );
                    $order->coupon = optional($order->voucher())->amount . '% Discount';
                } else {
                    $order->coupon = 'Coupon';
                    $order->coupon_value = '----';
                }


                try {
                    $when = now()->addMinutes(5);
                    Mail::to($user->email)
                        ->bcc('damilola@autofactorng.com')
                        ->cc('jacob.atam@gmail.com')
                        ->send(new OrderReceipt($order, null, null, $sub_total));
                } catch (\Throwable $th) {
                    Log::info("Mail error :" . $th);
                    Log::info("Custom error :" . $th);
                    $err = new Error();
                    $err->error = $th->getMessage();
                    $err->save();
                }

                //delete cart
                if ($input['coupon']) {
                    $code = trim($input['coupon']);
                    $coupon =  Voucher::where('code', $input['coupon'])->first();
                    if (null !== $coupon && $coupon->type == 'specific') {
                        $coupon->update(['valid' => false]);
                    }
                }

                // \Log::info($cart);

                return http_response_code(200);
            }



            if ($input['type'] == 'Wallet') {

                // $wallet = new Wallet;
                // $wallet->amount = $input['amount'];
                // $wallet->user_id = $input['customer_id'];
                // $wallet->status = 'Added';
                // $wallet->save();

                // $balance = WalletBalance::where('user_id', $input['customer_id'])->first();

                // if (null !== $balance) {
                //     $balance->balance = $balance->balance +  $input['amount'];
                //     $balance->save();
                // } else {
                //     $balance = new WalletBalance;
                //     $balance->balance = $input['amount'];
                //     $balance->user_id = $input['customer_id'];
                //     $balance->save();
                // }

                // \Log::info($balance);
            }
        } catch (\Throwable $th) {
            \Log::info("Custom error :" . $th);
            Log::info("Custom error :" . $th);
            $err = new Error();
            $err->error = $th->getMessage();
            $err->save();
        }

        return http_response_code(200);
    }

    public function gitHub()
    {
        $output =  shell_exec('sh /home/forge/autofactor.ng/deploy.sh');
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

            Log::info($data);


            Log::info($pending_cart);

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
            $order->shipping_price = optional(Shipping::find($pending_cart->shipping_id))->price;
            //$order->currency = '₦';
            $order->invoice = "INV-" . date('Y') . "-" . rand(10000, 39999);
            $order->tracking = time();

            $order->payment_type = 'Online Zilla';
            $order->total = $pending_cart->total;
            $order->ip = $request->ip();
            $order->first_name = optional($user->active_address)->first_name;
            $order->last_name = optional($user->active_address)->last_name;
            $order->address = optional($user->active_address)->address;
            $order->email = $user->email;
            $order->phone_number = $user->phone_number;
            $order->city  = optional($user->active_address)->city;
            $order->state = optional(optional($user->active_address)->address_state)->name;
            $order->country = optional(optional($user->active_address)->address_country)->name;

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
                    'price' => $cart->ConvertCurrencyRate($cart->price),
                    'total' => $cart->ConvertCurrencyRate($cart->quantity * $cart->price),
                    'created_at' => \Carbon\Carbon::now()
                ];
                OrderedProduct::Insert($insert);
                $cart->delete();
            }

            $admin_emails = explode(',', $this->settings->alert_email);
            $symbol = optional($currency)->symbol;
            $total =  DB::table('ordered_products')->select(\DB::raw('SUM(ordered_products.price*ordered_products.quantity) as items_total'))->where('order_id', $order->id)->get();
            $sub_total = $total[0]->items_total ?? '0.00';
            $order->currency = '₦';

            if ($order->coupon) {
                $order->coupon_value = '-₦' . number_format(
                    (optional($order->voucher())->amount / 100) * $sub_total
                );
                $order->coupon = optional($order->voucher())->amount . '% Discount';
            } else {
                $order->coupon = 'Coupon';
                $order->coupon_value = '----';
            }

            try {
                $when = now()->addMinutes(5);
                Mail::to($user->email)
                    ->bcc('damilola@autofactorng.com')
                    ->cc('jacob.atam@gmail.com')
                    ->send(new OrderReceipt($order, null, null, $sub_total));
            } catch (\Throwable $th) {
                Log::info("Mail error :" . $th);
                $err = new Error();
                $err->error = $th->getMessage();
                $err->save();
            }

            //delete cart
            if ($pending_cart->coupon) {
                $code = trim($pending_cart->coupon);
                $coupon =  Voucher::where('code', $code)->first();
                if (null !== $coupon && $coupon->type == 'specific') {
                    $coupon->update(['valid' => false]);
                }
            }
        } catch (\Throwable $th) {
            Log::info("Custom error :" . $th);
            $err = new Error();
            $err->error = $th->getMessage();
            $err->save();
            // Notification::route('mail', 'jacob.atam@gmail.com')
            //     ->notify(new ErrorNotification($th));
        }

        return http_response_code(200);
    }
}
