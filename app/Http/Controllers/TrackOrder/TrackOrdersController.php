<?php

namespace App\Http\Controllers\TrackOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\AccountSettingsNav;
use App\Models\Order;

class TrackOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = (new AccountSettingsNav())->nav();
        return view('tracking.index', compact('nav'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request  $request,  $id)
    {
        $order = Order::find($id);

        if (null !== $order) {
            return $order->order_statuses;
        }

        return null;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
