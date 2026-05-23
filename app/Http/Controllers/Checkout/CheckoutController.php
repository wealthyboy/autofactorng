<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Mail\OrderReceipt;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\WalletBalance;
use App\Models\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\AbandonedCart;
use App\Models\AbandonedCartItem;
use App\Services\InDriveCouponService;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts =  Cart::all_items_in_cart();

        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();


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

        // Prepare and insert abandoned cart items


        // Optional: delete existing items before re-inserting (if you want fresh snapshot)
        $abandonedCart->items()->delete();

        // Insert new items
        AbandonedCartItem::insert($items->toArray());

        if (!$carts->count()) {
            return redirect()->to('/cart');
        }
        return view('checkout.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function confirm(Request $request)
    {

        $input = $request->all();
        $indriveCoupon = app(InDriveCouponService::class);

        try {
            DB::beginTransaction();
            $payment_method = $input['payment_method'];
            $ip = $request->ip();
            $user = Auth::user();
            $carts = Cart::all_items_in_cart();

            if (($input['zone'] ?? null) === 'Pickup' && $payment_method === 'payment_on_delivery') {
                return response()->json(['error' => 'Pay on delivery is not available for pickup orders'], 422);
            }

            if ($indriveCoupon->isProtectedCoupon($input['coupon'] ?? null)) {
                return response()->json(['error' => 'Coupon is invalid'], 422);
            }

            if ($indriveCoupon->isInDriveUser($user) && $indriveCoupon->applyToSubtotal((float) Cart::sum_items_in_cart())['code']) {
                $input['coupon'] = InDriveCouponService::CODE;
            }

            $input['referer'] = session('original_referer');  // ← Capture referer from session
            $order = Order::checkout($input, $payment_method,  $ip, $carts, $user);
            $code = $indriveCoupon->isInDriveUser($user) && $indriveCoupon->applyToSubtotal((float) Cart::sum_items_in_cart())['code']
                ? InDriveCouponService::CODE
                : trim(session('coupon'));

            if ($request->payment_method == 'Wallet') {
                WalletBalance::deductFromWallet($request->total);
            }

            if ($request->payment_method == 'auto_credit') {
                WalletBalance::deductFromCredit($request->total);
            }

            $sub_total = Order::subTotal($order);
            Order::getCoupon($order, $sub_total);

            $order->discount = $order->coupon_value;




            $coupon_value = $order->coupon_value != "" ? $order->coupon_value : "₦0.0";

            Order::sendMail($user, $order, $sub_total,  $coupon_value);

            if (! $indriveCoupon->isProtectedCoupon($code)) {
                Voucher::inValidate($code);
            }

            DB::commit();



            $request->session()->forget('coupon');
            $request->session()->forget('coupon_total');
            $request->session()->forget('is_indrive_customer');
            $request->session()->forget('acquisition_source');
            $request->session()->forget('acquisition_source_at');
            $request->session()->forget('indrive_session_id');
            $request->session()->forget('indrive_driver_id');
            $request->session()->forget('indrive_verified');
            Cookie::queue(Cookie::forget('cart'));
            return response()->json([
                'status' => 'Order pLaced'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }




        // return $input;


        //unset the coupon
        // $request->session()->forget('coupon');
        // $request->session()->forget('coupon_total');
        // Cookie::queue(Cookie::forget('cart'));
        // return response()->json([
        //     'status' => 'Order pLaced'
        // ], 200);
    }


    public function getReferer(Request $request)
    {
        return response()->json([
            'referer' => session('original_referer')
        ]);
    }


    protected function coupon(Request $request)
    {
        if (app(InDriveCouponService::class)->isProtectedCoupon($request->coupon)) {
            return response()->json([
                'error' => 'Coupon is invalid',
            ], 422);
        }

        $cart_total  = Cart::sum_items_in_cart();

        if (!$cart_total) {
            $error['error'] = 'We cannot process your voucher';
            return response()->json($error, 422);
        }


        $user  =  \Auth::user();
        // Build the input for validation
        $coupon = array('coupon' => $request->coupon);
        // Tell the validator that this file should be an image
        $rules = array(
            'coupon' => 'required'
        );

        // Now pass the input and rules into the validator
        $validator = \Validator::make($coupon, $rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $coupon =  Voucher::where('code', $request->coupon)
            ->where('status', 1)
            ->first();

        $order =  Order::where('coupon', $request->coupon)
            ->first();

        $error = array();

        if (empty($coupon)) {
            $error['error'] = 'Coupon is invalid ';
            return response()->json($error, 422);
        }

        if ($coupon->is_coupon_expired()) {
            $error['error'] = 'Coupon has expired';
            return response()->json($error, 422);
        }


        if ($coupon->belongs_to_user && $coupon->user_id !== optional(auth()->user())->id) {
            $error['error'] = 'Coupon does not belongs to you';
            return response()->json($error, 422);
        }

        if ($coupon->belongs_to_user && null !== $order) {
            $error['error'] = 'Coupon has been used';
            return response()->json($error, 422);
        }

        if ($cart_total < $coupon->from_value) {
            $error['error'] = 'You can only use this coupon when your purchase is above  '  . $coupon->from_value;
            return response()->json($error, 422);
        }

        if (!$coupon->is_valid()) {
            $error['error'] = 'Coupon is invalid ';
            return response()->json($error, 422);
        }
        //get all the infomation 
        $total = [];

        $total['currency'] = '';


        if (!empty($coupon->from_value) && $cart_total >= $coupon->from_value) {

            if ($coupon->is_fixed) {
                $new_total = $cart_total - $coupon->amount;
                $total['sub_total'] = round($new_total, 0);
                $total['actual_total'] = round($cart_total, 0);
                $request->session()->put(['new_total' => $new_total]);
                $request->session()->put(['coupon_total' => $new_total]);
                $request->session()->put(['coupon' => $request->coupon]);
                $total['percent'] = $coupon->amount . '%  percent off';
                return response()->json($total, 200);
            }


            $new_total = ($coupon->amount * $cart_total) / 100;
            $new_total = $cart_total - $new_total;
            $total['sub_total'] = round($new_total, 0);
            $request->session()->put(['new_total' => $new_total]);
            $request->session()->put(['coupon_total' => $new_total]);
            $request->session()->put(['coupon' => $request->coupon]);
            $total['percent'] = $coupon->amount . '%  percent off';
            $total['perceneet2'] = $coupon->amount . '%  percent off';

            return response()->json($total, 200);
        } else if (!empty($coupon->from_value) && $cart_total < $coupon->from_value) {
            $error['error'] = 'Coupon is invalid ';
            return response()->json($error, 422);
        } else {


            if ($coupon->is_fixed) {
                $new_total = $cart_total - $coupon->amount;
                $total['sub_total'] = round($new_total, 0);
                $request->session()->put(['new_total' => $new_total]);
                $request->session()->put(['coupon_total' => $new_total]);
                $request->session()->put(['coupon' => $request->coupon]);
                $total['percent'] = '-' . $coupon->amount . '  Value Deducted';
                $total['percednt2'] = $coupon->amount . '%  percent off';
                return response()->json($total, 200);
            }

            // dd("wwww");


            $new_total = ($coupon->amount * $cart_total) / 100;
            $new_total = $cart_total - $new_total;
            $total['sub_total'] =   $new_total;
            $request->session()->put(['new_total' => $new_total]);
            $request->session()->put(['coupon_total' => $new_total]);
            $request->session()->put(['coupon' => $request->coupon]);
            $total['percent'] = $coupon->amount . '%  percent off';
            $total['percent2'] = $coupon->amount . '%  percent off';

            return response()->json($total, 200);
        }
    }
}
