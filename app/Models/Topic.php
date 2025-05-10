<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory, ColumnFillable;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'forum_category_id');
    }




    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function latestUsers()
    {
        return $this->users()->latest()->take(3);
    }


    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

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
