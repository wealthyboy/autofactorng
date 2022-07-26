<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageFiles;

class Product extends Model
{
    use HasFactory, ImageFiles;



    protected $fillable = [
        'amphere',
        'name',
        'slug',
        'price',
        'brand_id',
        'generic_name',
        'rim_size',
        'radius',
        'keywords',
        'title',
        'meta_description',
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
        'has_variants',
        'phy_desc',
        'product_name',
        'large_item_shipping_price',
        'sale_price_starts',
        'condition_is_present',
        'sale_price_ends',
        'volts'

    ];

    public $folder = 'products';

    const AMPHERES  = [
			"45",
			"62",
			"65",
			"75",
			"80",
			"90",
			"100",
			"120",
			"150",
			"200",
        ];

    public $appends = [
		'image_m',
        'category_name',
        'image_to_show'
	];

    public function attributes(){
        return $this->belongsToMany(Attribute::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id');
	}

    public function engines()
    {
        return $this->belongsToMany(Engine::class)->withPivot('attribute_id');
	}

    public function product_engines()
    {
        return $this->hasMany(EngineProduct::class);
	}

    public function category()
    {
        return $this->belongsToMany(Category::class);
	}

    public function related_products()
    {
        return $this->hasMany(RelatedProduct::class);
	}


    public function product_years()
    {
        return $this->hasMany(ProductYear::class);
	}

    public function product_rates()
    {
        return $this->hasMany(ShippingRate::class);
	}

    public function getCategoryNameAttribute()
    {
        return optional(optional($this->categories()->orderBy('id','DESC'))->first())->name;
	}

    public function heavy_item_lagos()
    {
        return $this->hasMany(ShippingRate::class)->where('is_lagos', true);
	}


    public function heavy_item_outside_lagos()
    {
        return $this->hasMany(ShippingRate::class)->where('is_lagos', false);
	}

}

