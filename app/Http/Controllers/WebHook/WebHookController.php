<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use App\User;
// use App\Order;
// use App\OrderedProduct;
// use App\Cart;
// use App\Currency;
// use App\Shipping;
// use App\ProductVariation;
// use App\Voucher;
use App\Models\Wallet;
use App\Models\WalletBalance;


// use App\Mail\OrderReceipt;
// use App\Mail\SendGiftCard;

// use App\Jobs\ReviewProduct;

// use App\SystemSetting;
// use Illuminate\Support\Facades\DB;


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
