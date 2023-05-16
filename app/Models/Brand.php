<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name', 'image', 'is_featured'];

    public function link()
    {
        return '/products/' . $this->slug;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function getListingData($collection)
    {

        return  $collection->map(function ($brand) {
            return [
                "Id" => $brand->id,
                "Image" => $brand->image,
                "Name" => $brand->name,
            ];
        });
    }

    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Image" => 'image',
            "Name" => 'name',
        ];

        return $sort[$key];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
