<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use App\User;
// use App\Order;
// use App\OrderedProduct;
// use App\Cart;
// use App\Currency;
// use App\Shipping;
// use App\ProductVariation;
// use App\Voucher;
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
    

    // public function payment(Request $request,OrderedProduct $ordered_product,Order $order)
    // {   
        

    //     try {
    //         \Log::info($request->all());
    //         $input    =  $request->data['metadata']['custom_fields'][0];
    //         $user     =  User::findOrFail($input['customer_id']);
    //         $carts    =  Cart::find($input['cart']);

    //         \Log::info($carts);
            
        
    //         foreach ($carts as $cart) {
    //             if ( $cart->quantity  < 1 ){
    //                 $cart->delete();
    //             }
    //         }


    //         if (null == $carts){
    //             return  http_response_code(200);
    //         }

    //         $currency       =  Currency::where('iso_code3',$request->data['currency'])->first();
    //         $shipping_id    = isset($input['shipping_id']) ? $input['shipping_id'] : null;
    //         $order->user_id = $user->id;
    //         $order->address_id         =  optional($user->active_address)->id;
    //         $order->coupon             =  $input['coupon'];
    //         $order->status             =  'Processing';
    //         $order->shipping_id        =  $shipping_id;
    //         $order->shipping_price     =  optional(Shipping::find($shipping_id))->converted_price;
    //         $order->currency           =  optional($currency)->symbol ?? '₦';
    //         $order->invoice            =  "INV-".date('Y')."-".rand(10000,39999);
    //         $order->payment_type       =  $request->data['authorization']['channel'];
    //         $order->delivery_option    =  $input['delivery_option'];
    //         $order->delivery_note      =  $input['delivery_note'];
    //         $order->total              =  $input['total'];
    //         $order->ip                 =  $request->data['ip_address'];
    //         $order->first_name         =  optional($user->active_address)->first_name;
    //         $order->last_name          =  optional($user->active_address)->last_name;
    //         $order->address            =  optional($user->active_address)->address;
    //         $order->email              =  optional($user->active_address)->email;
    //         $order->phone_number       =  optional($user->active_address)->phone_number;
    //         $order->city               =  optional($user->active_address)->city;
    //         $order->state              =  optional(optional($user->active_address)->address_state)->name;
    //         $order->country            =  optional(optional($user->active_address)->address_country)->name;
    
    //         $order->save();

    //         foreach ( $carts   as $cart){
    //             $insert = [
    //                 'order_id'=>$order->id,
    //                 'product_variation_id'=>$cart->product_variation_id,
    //                 'quantity'=>$cart->quantity,
    //                 'status'=>"Processing",
    //                 'price'=>$cart->ConvertCurrencyRate($cart->price),
    //                 'total'=>$cart->ConvertCurrencyRate($cart->quantity * $cart->price),
    //                 'created_at'=>\Carbon\Carbon::now()
    //             ];
    //             OrderedProduct::Insert($insert);
    //             $product_variation = ProductVariation::find($cart->product_variation_id);
    //             $qty  = $product_variation->quantity - $cart->quantity;
    //             $product_variation->quantity =  $qty < 1 ? 0 : $qty;
    //             $product_variation->save();

    //             if($cart->is_gift_card){
    //                 try {
    //                     $when = now()->addMinutes(5); 
    //                     \Mail::to($cart->gift_card_to_email)
    //                     ->send(new SendGiftCard($cart, $this->settings));
    //                 } catch (\Throwable $th) {
    //                    Log::info("Mail error :".$th);
    //                 }
    //             }

    //             //Delete all the cart
    //             $cart->delete();
    //         }
            
    //         $admin_emails = explode(',',$this->settings->alert_email);
    //         $symbol = optional($currency)->symbol  ;
    //         $total =  DB::table('ordered_product')->select(\DB::raw('SUM(ordered_product.price*ordered_product.quantity) as items_total'))->where('order_id',$order->id)->get();
    //         $sub_total = $total[0]->items_total ?? '0.00';
            
    //         try {
    //             $when = now()->addMinutes(5); 
    //             \Mail::to($user->email)
    //             ->bcc($admin_emails[0])
    //             ->send(new OrderReceipt($order,$this->settings,$symbol,$sub_total));
    //          } catch (\Throwable $th) {
    //             Log::info("Mail error :".$th);
    //         }

    //         //delete cart
    //         if ( $input['coupon'] ) {
    //             $code = trim($input['coupon']);
    //             $coupon =  Voucher::where('code', $input['coupon'])->first();
    //             if(null !== $coupon && $coupon->type == 'specific'){
    //                 $coupon->update(['valid'=>false]);
    //             }
    //         }

    //         ReviewProduct::dispatch($order, $user)->delay(now()->addDays(10));

    //     } catch (\Throwable $th) {
    //         Log::info("Custom error :".$th);

    //     }

    //     return http_response_code(200);
        

    // }

    public function gitHub()
    {
        $output =  shell_exec('sh /home/forge/autofactor.ng/deploy.sh');
        return  $output;
    }

   
}
