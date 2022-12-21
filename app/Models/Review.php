<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    public function getListingData($collection)
    {

        return  $collection->map(function ($review) {
            return [
                "Id" => $review->id,
                "Title" => $review->title,
                "Product Name" => optional($review->product)->product_name,
                "Author Name" =>  optional($review->user)->name,
                "Rating" => $review->rating / 20,
                "Date Added" => $review->created_at->format('d/m/y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Title" => 'title',
            "Product Name" => 'product_id',
            "Author Name" =>  'user_id',
            "Rating" => 'rating',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
