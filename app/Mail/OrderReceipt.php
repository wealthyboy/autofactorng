<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class OrderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $settings;

    public $currency;

    public $sub_total;

    public $coupon_value;



    public function __construct($order, $settings, $symbol, $sub_total, $coupon_value)
    {

        $this->order = $order;
        $this->settings = $settings;
        $this->currency = $symbol;
        $this->coupon_value = $coupon_value;

        $this->prepareReceiptProducts($sub_total);
    }

    protected function prepareReceiptProducts($sub_total)
    {
        $this->order->loadMissing('ordered_products.product');

        $originalProducts = $this->order->ordered_products;
        $receiptProducts = $originalProducts
            ->sortByDesc('id')
            ->unique(function ($product) {
                $productName = strtolower(trim((string) $product->product_name));

                return $productName !== '' ? 'name:' . $productName : 'product:' . $product->product_id;
            })
            ->values();

        $this->order->setRelation('ordered_products', $receiptProducts);
        $this->sub_total = $receiptProducts->sum('total') ?: $sub_total;

        Log::info('receipt.order_payload', [
            'order_id' => $this->order->id,
            'invoice' => $this->order->invoice ?? null,
            'order_total' => $this->order->total ?? null,
            'order_total_formatted' => method_exists($this->order, 'get_total') ? $this->order->get_total() : null,
            'shipping_price' => $this->order->shipping_price ?? null,
            'heavy_item_price' => $this->order->heavy_item_price ?? null,
            'coupon_value' => $this->coupon_value,
            'incoming_sub_total' => $sub_total,
            'receipt_sub_total' => $this->sub_total,
            'original_count' => $originalProducts->count(),
            'receipt_count' => $receiptProducts->count(),
            'original_products' => $originalProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'order_id' => $product->order_id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'total' => $product->total,
                ];
            })->values()->all(),
            'receipt_products' => $receiptProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'order_id' => $product->order_id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'total' => $product->total,
                ];
            })->values()->all(),
        ]);
    }


    public function build()
    {
        $this->prepareReceiptProducts($this->sub_total);

        return $this->subject('Order Confirmation')->view('emails.receipt.index');
    }
}
