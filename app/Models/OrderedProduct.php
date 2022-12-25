<?php

namespace App\Models;

use App\Http\Helper;
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
                        "Product" => $ordered_product->product_name,
                        "Price" =>  Helper::currencyWrapper($ordered_product->price),
                        "Quantity" => $ordered_product->quantity,
                        "Sub Total" =>  Helper::currencyWrapper($ordered_product->total),
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
                'show_checkbox' => false,
                'urls' => $collection->map(function ($obj) {
                    return [
                        "url" => '/admin/' . $this->link . '/' . $obj->id,
                    ];
                })

            ],
            'unique' =>  $this->unique(),
            'routes' => $this->routes()
        ];
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Product" => 'product_name',
            "Price" =>  'price',
            "Quantity" => 'quantity',
            "Sub Total" =>  'total',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'admin.orders.edit',
                'order'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'admin.orders.destroy',
                'order'
            ],
            'create' => [
                'admin.orders.create'
            ],
            'index' => null
        ];
    }

    public function unique()
    {
        return [
            'show'  => false,
            'right' => false,
            'edit' => false,
            'search' => false,
            'add' => false,
            'delete' => false,
            'export' => false,
            'order' => false
        ];
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
