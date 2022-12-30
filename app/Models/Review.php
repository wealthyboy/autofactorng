<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function number_of_occurencies($product_id)
    {
        $result = \DB::table('reviews')->select(DB::raw('COUNT(rating) AS occurrences'))
            ->groupBy('rating')
            ->orderBy('occurrences', 'DESC')
            ->where(['reviews.product_id' => $product_id])
            ->first();
        return $result  !== null ? $result->occurrences : 0;
    }

    public function reviewPercent($number, $total)
    {
        return ($number * 100) / $total;
    }

    public function highest_rating($product_id)
    {
        $result = static::select('rating')
            ->groupBy('rating')
            ->orderByRaw('COUNT(*) DESC')
            ->where(['reviews.product_id' => $product_id])
            ->first();
        return $result !== null ?  $result->rating : 0;
    }


    public function img()
    {
        return $this->image ? $this->image : '/image/utilities/profile.png';
    }

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
