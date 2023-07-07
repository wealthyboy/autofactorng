<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\PendingCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Your Cart  ";
        return view('carts.index', compact('page_title'));
    }


    public function meta(Request $request)
    {

        $pending_cart = PendingCart::firstOrNew(
            ['user_id' => $request->user_id]
        );
        $pending_cart->cart_ids = $request->cartId;
        $pending_cart->coupon = $request->coupon;
        $pending_cart->delivery_note = $request->delivery_note;
        $pending_cart->shipping_id = $request->shipping_id;
        $pending_cart->heavy_item_price = $request->heavy_item_price;
        $pending_cart->shipping_price = $request->shipping_price;
        $pending_cart->uuid = $request->uuid;
        $pending_cart->total = $request->total;
        $pending_cart->save();
        return $pending_cart;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
