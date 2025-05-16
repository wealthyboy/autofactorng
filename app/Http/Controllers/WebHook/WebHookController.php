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


        Log::info($request->all());
        $input =  $request->data['metadata']['custom_fields'][0];

        if ($input['type'] == 'order_from_paystack') {

            Log::info($request->all());
            $input = $request->data['metadata']['custom_fields'][0];
            $user = User::findOrFail($input['customer_id']);
            $carts = Cart::find($input['cart']);

            if (null == $carts) {
                return  http_response_code(200);
            }

            $payment_method = $request->data['authorization']['channel'];
            $ip = $request->data['ip_address'];
            $order = Order::checkout($input, $payment_method,  $ip,  $carts,  $user);
            if ($amount = data_get($input, 'wallet')) {
                WalletBalance::deductFromWallet($amount, $user);
            }
            $admin_emails = explode(',', $this->settings->alert_email);
            $sub_total = Order::subTotal($order);

            Order::getCoupon($order, $sub_total);
            Order::sendMail($user, $order, $sub_total);
            Voucher::inValidate($input['coupon']);

            return http_response_code(200);
        }


        return http_response_code(200);
    }

    public function gitHub()
    {
        $output = shell_exec('sh /var/www/autofactorng.com/deploy.sh');
        return  $output;
    }
}
