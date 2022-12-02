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
        $pagination = auth()->user()->orders()->paginate(4);
        $collections = $this->getColumnNames($pagination);
        $columns = $this->getGetCustomColumnNames();
        $nav = (new AccountSettingsNav())->nav();

        if (request()->ajax()) {
            return response([
                'collections' => $this->getColumnNames($pagination),
                'pagination' =>  $pagination
            ]);
        }

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
        $page_title = 'Order Information';
        $nav = (new AccountSettingsNav())->nav();

        // $currency = $this->settings->currency->symbol;
        // $total = $order->ordered_products[0]->sum_items($order->id)->items_total;
        // $currency =  Helper::getCurrency();
        return view('orders.show', compact('nav', 'order', 'page_title'));
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
                        "Customer" =>  \Auth::user()->fullname(),
                        "Total" => '₦' . optional($order)->total,
                        "Date Added" => $order->created_at->format('d-m-y')
                    ];
                })
            ],
            'meta' => [
                'show' => true,
                'right' => null,
                'urls' =>  $collection->map(function (Order $order) {
                    return [
                        "url" => '/orders/' . optional($order)->id,
                    ];
                })
            ]
        ];
    }
}
