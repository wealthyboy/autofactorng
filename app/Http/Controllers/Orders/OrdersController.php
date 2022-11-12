<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Utils\AccountSettingsNav;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = (new AccountSettingsNav())->nav();
        $pagination = auth()->user()->orders()->paginate(4);
        $collections = $this->getColumnNames($pagination);
        $columns = $this->getGetCustomColumnNames();
        return view('orders.index', compact('nav', 'collections', 'columns', 'pagination'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }


    protected function getGetCustomColumnNames()
    {
        return [
            "order id",
            "customer",
            "total",
            "date_added",
        ];
    }

    protected function getColumnNames($collection)
    {
        return [
            'items' => [
                $collection->map(function (Order $order) {
                    return [
                        "order id" => '#' . optional($order)->id,
                        "customer" =>  \Auth::user()->fullname(),
                        "total" => '₦' . optional($order)->total,
                        "date_added" => $order->created_at->format('d-m-y')
                    ];
                })
            ],
            'meta' => [
                'show' => true,
                'right' => null
            ]
        ];
    }
}
