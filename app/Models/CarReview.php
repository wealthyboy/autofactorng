<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use App\Traits\ImageFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarReview extends Model
{
    use HasFactory, ColumnFillable, ImageFiles;

    public $folder = "car_reviews";

    public $appends = [
        'image_l',
        'image_m',
        'image_to_show',
        'm_image'
    ];


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
