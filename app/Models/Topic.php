<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory, ColumnFillable;

    public $appends = [
        'date'
    ];


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


    public function getDateAttribute()
    {
        return optional($this->created_at)->shortRelativeDiffForHumans();
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
                "Category" => optional($carReview->category)->name,
                "Pinned" => $carReview->pinned ? 'Pinned' : 'Not Pinned',
                "Image" => null !== $carReview->image ?  $carReview->image : '/images/utils/No_image_available.svg.png',
                "Date Added" => $carReview->created_at->format('d-m-y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Image" => 'id',
            "Category" => 'forum_category_id',
            "Title" => 'product_name',
            "Pinned" => 'pinned',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
