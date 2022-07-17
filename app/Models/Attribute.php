<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasChildren;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasChildren, HasFactory;

    public $appends = [
        
    ];

    public static $types = [
        'Make',
        'Model',
        'Year',
        'Ampere-Hour(AH)',
        'Brand',
        
    ];


    public function children()
    {
        return $this->hasMany(Attribute::class,'parent_id','id');
    }


    public function attribute_years()
    {
        return $this->hasMany(AttributeYear::class);
    }


    public function parent()
    {
        return $this->belongsTo(Attribute::class,'parent_id','id');
    }


    public function engines()
    {
        return $this->belongsToMany(Engine::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->groupBy('attribute_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id');
    }

    public function information()
    {
        return $this->belongsToMany(Information::class)->withPivot('information_id');
    }

}
