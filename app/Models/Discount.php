<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'amount',
        'expires'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getListingData($collection)
    {
        return  $collection->map(function ($discount) {
            return [
                "Id" =>  $discount->id,
                "Amount Percent" =>  $discount->amount,
                "Category" => optional($discount->category)->name,
                "Date Added" =>  $discount->created_at->format('d-m-y'),
            ];
        });
    }

    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Amount Percent" => 'amount',
            "Category" => 'category_id',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
