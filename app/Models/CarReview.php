<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarReview extends Model
{
    use HasFactory, ColumnFillable;


    public function getListingData($collection)
    {
        return  $collection->map(function ($carReview) {
            return [
                "Id" => $carReview->id,
                "title" => $carReview->title,
                "Image" => $carReview->image,
                "Date Added" => $carReview->created_at->format('d-m-y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Image" => 'id',
            "title" => 'product_name',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
