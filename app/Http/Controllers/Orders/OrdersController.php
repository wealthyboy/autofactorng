<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Utils\AccountSettingsNav;
use App\DataTable\Table;



class OrdersController extends Table
{

    public $link = '/orders';


    public function builder()
    {
        return Order::query();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::has('ordered_products')->where('user_id', auth()->user()->id)->latest()->orderBy('created_at', 'desc')->paginate(450);
        $orders = $this->getColumnListings(request(), $orders);
        $nav = (new AccountSettingsNav())->nav();


        if (request()->ajax()) {
            return response([
                'collections' =>  $orders,
            ]);
        }

        return view('orders.index', compact('orders', 'nav'));
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
        $total = $order->ordered_products[0]->sum_items($order->id)->items_total;
        // $currency =  Helper::getCurrency();
        return view('orders.show', compact('nav', 'order', 'total', 'page_title'));
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'orders.edit',
                'order'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'orders.destroy',
                'order'
            ],
            'create' => [
                'orders.create'
            ],
            'index' => null
        ];
    }

    public function unique()
    {
        return [
            'show'  => true,
            'right' => false,
            'edit' => false,
            'search' => true,
            'add' => true,
            'delete' => false,
            'export' => true,
            'order' => true
        ];
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
