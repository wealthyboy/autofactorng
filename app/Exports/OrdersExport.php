<?php

namespace App\Exports;

use App\Http\Helper;
use App\Models\Customer;
use App\Models\CustomerWarehouse;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class OrderExport extends Exporter
{
    public function headings(): array
    {
        return [
            "Id",
            "Invoice",
            "Customer",
            "Email",
            "Payment Type",
            "Type",
            "Status",
            "Total",
            "Date",
        ];
    }

    public function collection()
    {

        ini_set('memory_limit', -1);
        // $items = data_get($this->filter, 'items', []);
        $query = Order::query();
        // if (!data_get($this->filter, 'all_items')) {
        //   $query->whereIn('customer_id', $items);
        // }r

        $orders = $query->get();



        return $orders->map(function (Order $order) {

            return [
                $order->id,
                $order->invoice,
                optional($order->orderEmail)->fullname,
                optional($order->orderEmail)->email,
                $order->payment,
                $order->order_type,
                $order->status,
                Helper::currencyWrapper($order->total),
                $order->created_at->format('d-m-y'),
            ];
        });
    }
}
