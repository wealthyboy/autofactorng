<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageFiles;

class Product extends Model
{
    use HasFactory, ImageFiles;

    protected $fillable = [

        'name',
        'slug',
        'price',
        'brand_id',
        'make',
        'model',
        'generic_name',
        'rim_size',
        'radius',
        'year',
        'year_from',
        'year_to',
        'keywords',
        'title',
        'meta_description',
        'engine',
        'weight',
        'height',
        'width',
        'length',
        'description',
        'total',
        'sale_price',
        'sku',
        'barcode',
        'quantity',
        'allow',
        'featured',
        'has_variants'
        
    ];


    public $appends = [
		'image_to_show_m',
	];


    public function attributes(){
        return $this->belongsToMany(Attribute::class)
        ->groupBy('attribute_id')
        ->withPivot('attribute_id')
        ->withPivot('parent_id')
        ->withPivot('id');	
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id');
	}


    public function category()
    {
        return $this->belongsToMany(Category::class);
	}


    public function related_products()
    {
        return $this->hasMany(RelatedProduct::class);
	}

    

}

