<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;

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


    protected function coupon(Request $request)
    {

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

        $error = array();

        if (empty($coupon)) {
            $error['error'] = 'Coupon is invalid ';
            return response()->json($error, 422);
        }

        if ($coupon->is_coupon_expired()) {
            $error['error'] = 'Coupon has expired';
            return response()->json($error, 422);
        }


        if ($cart_total < $coupon->from_value) {
            $error['error'] = 'You can only use this coupon when your purchase is above  ' . $this->settings->currency->symbol . $coupon->from_value;
            return response()->json($error, 422);
        }


        if (!$coupon->is_valid()) {
            $error['error'] = 'Coupon is invalid ';
            return response()->json($error, 422);
        }
        //get all the infomation 
        $total = [];
        $total['currency'] = $this->settings->currency->symbol;

        if (!empty($coupon->from_value) && $cart_total >= $coupon->from_value) {
            $new_total = ($coupon->amount * $cart_total) / 100;
            $new_total = $cart_total - $new_total;
            $total['sub_total'] = round($new_total, 0);
            $request->session()->put(['new_total' => $new_total]);
            $request->session()->put(['coupon_total' => $new_total]);
            $request->session()->put(['coupon' => $request->coupon]);
            $total['percent'] = $coupon->amount . '%  percent off';
            return response()->json($total, 200);
        } else if (!empty($coupon->from_value) && $cart_total < $coupon->from_value) {
            $error['error'] = 'Coupon is invalid ';
            return response()->json($error, 422);
        } else {
            $new_total = ($coupon->amount * $cart_total) / 100;
            $new_total = $cart_total - $new_total;
            $total['sub_total'] =   $new_total;
            $request->session()->put(['new_total' => $new_total]);
            $request->session()->put(['coupon_total' => $new_total]);
            $request->session()->put(['coupon' => $request->coupon]);
            $total['percent'] = $coupon->amount . '%  percent off';
            return response()->json($total, 200);
        }
    }
}
