<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $table = 'ordered_products';

    protected $fillable = ['order_id', 'product_id', 'price', 'total', 'quantity', 'product_name'];

    public function getListingData($collection)
    {
        return [
            'items' => [
                $collection->map(function ($ordered_product) {
                    return [
                        "Image" =>  optional($ordered_product->product)->image_m,
                        "Product" => $ordered_product->product_name,
                        "Price" =>  '₦' . $ordered_product->price,
                        "Quantity" => $ordered_product->quantity,
                        "Sub Total" =>  '₦' .  $ordered_product->total,
                    ];
                })
            ],
            'meta' => [
                'show'  => false,
                'sub_total'  => true,
                'right' => null,
                'links' => $collection->links(),
                'count' => $collection->count(),
                'total' => $collection->total(),
                'firstItem' => $collection->firstItem(),
                'lastItem' => $collection->lastItem(),
                'urls' => $collection->map(function ($obj) {
                    return [
                        "url" => '/admin/' . $this->link . '/' . $obj->id,
                        "add" => '/admin/' . $this->link . '/' . $obj->id,
                    ];
                })
            ]
        ];
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
