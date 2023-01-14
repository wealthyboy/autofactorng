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
    public function getOrderStatus(Request  $request)
    {

        $request->validate([
            'tracking' => 'exists:orders'
        ]);

        $order_statuses  = Order::$statuses;
        $order = Order::where('tracking', $request->tracking)->first();
        $statuses = $order->order_statuses;
        $completed = $statuses->toArray();
        $uncompleted = array_diff($order_statuses, $statuses->pluck('status')->toArray());
        return response()->json([
            'completed' => $completed,
            'uncompleted' => $uncompleted
        ]);
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
