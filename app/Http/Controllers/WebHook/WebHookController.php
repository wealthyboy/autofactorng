<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Cart;
use App\Models\WalletBalance;


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
        Log::channel('payments')->info('Webhook received', $request->all());

        $input = $request->data['metadata']['custom_fields'][0] ?? null;
        $reference = $request->data['reference'] ?? null;

        if ($input && $input['type'] === 'order_from_paystack' || $input['type'] === 'wallet_and_paystack') {
            try {
                DB::beginTransaction();

                if ($reference && Order::where('reference', $reference)->exists()) {
                    Log::channel('payments')->warning('Duplicate webhook ignored', ['reference' => $reference]);
                    DB::rollBack();
                    return http_response_code(200);
                }

                $user  = User::findOrFail($input['customer_id']);
                $carts = Cart::find($input['cart']);

                if (is_null($carts)) {
                    DB::rollBack();
                    Log::channel('payments')->warning('Cart not found', $input);
                    return http_response_code(200);
                }

                $payment_method = $request->data['authorization']['channel'];
                $ip  = $request->data['ip_address'];

                // ✅ Save reference with the order
                $order = Order::checkout($input, $payment_method, $ip, $carts, $user);
                $order->reference = $reference;
                $order->referer = data_get($input, 'referer');  // ← Ensure referer is saved

                $order->save();

                if ($amount = data_get($input, 'wallet')) {
                    WalletBalance::deductFromWallet($amount, $user);
                }

                $sub_total = Order::subTotal($order);

                Order::getCoupon($order, $sub_total);

                $coupon_value = $order->coupon_value != "" ? $order->coupon_value : "₦0.0";
                Order::sendMail($user, $order, $sub_total, $coupon_value);
                Voucher::inValidate($input['coupon']);
                DB::commit();
                Log::channel('payments')->info('Order created successfully', ['order_id' => $order->id, 'reference' => $reference]);

                return http_response_code(200);
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::channel('payments')->error('Payment transaction failed: ' . $e->getMessage(), [
                    'trace'   => $e->getTraceAsString(),
                    'request' => $request->all(),
                ]);
                return response()->json(['error' => 'Payment processing failed'], 500);
            }
        }

        Log::channel('payments')->notice('Webhook ignored', $request->all());
        return http_response_code(200);
    }

    public function gitHub()
    {
        $output = shell_exec('sh /var/www/autofactorng.com/deploy.sh');
        return  $output;
    }
}
