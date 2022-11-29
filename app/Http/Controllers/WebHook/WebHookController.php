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
use App\Models\Product;
// use App\Mail\SendGiftCard;

// use App\Jobs\ReviewProduct;

// use App\SystemSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{

    public  $settings;

    public function __construct()
    {
        //$this->settings =  Setting::first();
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



                // $admin_emails = explode(',', $this->settings->alert_email);
                // $symbol = optional($currency)->symbol;
                // $total =  DB::table('ordered_product')->select(\DB::raw('SUM(ordered_product.price*ordered_product.quantity) as items_total'))->where('order_id', $order->id)->get();
                // $sub_total = $total[0]->items_total ?? '0.00';

                // try {
                //     $when = now()->addMinutes(5);
                //     \Mail::to($user->email)
                //         ->bcc($admin_emails[0])
                //         ->send(new OrderReceipt($order, $this->settings, $symbol, $sub_total));
                // } catch (\Throwable $th) {
                //     Log::info("Mail error :" . $th);
                // }

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

                $wallet = new Wallet;
                $wallet->amount = $input['amount'];
                $wallet->user_id = $input['customer_id'];
                $wallet->status = 'Added';
                $wallet->save();

                $balance = WalletBalance::where('user_id', $input['customer_id'])->first();

                if (null !== $balance) {
                    $balance->balance = $balance->balance +  $input['amount'];
                    $balance->save();
                } else {
                    $balance = new WalletBalance;
                    $balance->balance = $input['amount'];
                    $balance->user_id = $input['customer_id'];
                    $balance->save();
                }

                \Log::info($balance);
            }
        } catch (\Throwable $th) {
            \Log::info("Custom error :" . $th);
        }

        return http_response_code(200);
    }

    public function gitHub()
    {
        $output =  shell_exec('sh /home/forge/autofactor.ng/deploy.sh');
        return  $output;
    }
}
