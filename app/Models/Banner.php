<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function scopeSliders(Builder $builder)
    {
        return $builder->where('slider', true)->orderBy('sort_order', 'asc');
    }

    public function scopeBanners(Builder $builder)
    {
        return $builder->orderBy('sort_order', 'asc');
    }

    public function image_path()
    {
        return asset('image/banners/' . $this->image);
    }


    public function getListingData($collection)
    {

        return  $collection->map(function ($banner) {
            return [
                "Id" => $banner->id,
                "Image" => $banner->image,
                "Title" => $banner->title,
                "Link" =>  $banner->link,
                "Sort Order" => $banner->sort_order,
                "Date Added" => $banner->created_at->format('d/m/y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Image" => 'image',
            "Title" => 'title',
            "Link" => 'link',
            "Sort Order" => 'sort_order',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
