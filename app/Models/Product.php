<?php

namespace App\Models;

use App\Filters\ProductsFilter\ProductFilters;
use App\Traits\FormatPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class Product extends Model
{
    use HasFactory, ImageFiles, FormatPrice;

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
        'volts',
        'is_featured'

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
        'image_to_show',
        'link',
        'discounted_price',
        'percentage_off',
        'formatted_price',
        'formatted_sale_price',
        'currency',
        'fits',
        'fitText'
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
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

    public function getCurrencyAttribute()
    {
        return '₦';
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function link()
    {
        $link  = '/product/';
        $link .=  optional(optional($this->categories)->first())->slug . '/';
        $link .= $this->slug;
        return $link;
    }

    public function related_products()
    {
        return $this->hasMany(RelatedProduct::class);
    }


    public function make_model_year_engines()
    {
        return $this->hasMany(MakeModelYearEngine::class);
    }


    public function scopeFilter(Builder $builder, $request)
    {
        return (new ProductFilters($request))->filter($builder);
    }


    public function product_years()
    {
        return $this->hasMany(MakeModelYearEngine::class);
    }

    public function product_rates()
    {
        return $this->hasMany(ShippingRate::class);
    }

    public function getCategoryNameAttribute()
    {
        return optional(optional($this->categories()->orderBy('id', 'DESC'))->first())->name;
    }

    public function getLinkAttribute()
    {
        return $this->link();
    }


    public static function getFilterForCategory(Category $category, $type = 'radius')
    {
        if (strtolower($category->search_type) == 'tyre' || strtolower($category->search_type) == 'battery') {
            return self::where($type, '!=', null)->select($type)->groupBy($type)->orderBy($type, 'asc')->get();
        }

        return null;
    }


    public function getListingData($collection)
    {

        return  $collection->map(function ($product) {
            return [
                "Id" => $product->id,
                "Image" => $product->image_to_show_m,
                "Name" => $product->product_name,
                "Category" => $product->category_name,
                "Price" =>  number_format($product->price),
                "Date Added" => $product->created_at->format('d-m-y'),
            ];
        });
    }


    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Image" => 'image',
            "Name" => 'product_name',
            "Category" => 'brand_id',
            "Price" => 'price',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }


    public function getFitsAttribute()
    {
        return $this->buildSearchString() ? true : false;
    }


    public function getFitTextAttribute()
    {
        if (request()->type == 'tyre') {
            return 'Fits your vehicle';
        }

        return $this->buildSearchString() ? 'Fits your ' . $this->buildSearchString() : "Check if it fits your vehicle";
    }


    public  function buildSearchString()
    {

        if (null !== request()->cookie('engine_id') &&  request()->type !== 'clear') {
            $year = request()->cookie('year');
            $make_name = Attribute::find(request()->cookie('make_id'))->name;
            $model_name = Attribute::find(request()->cookie('model_id'))->name;
            $engine_name = optional(Engine::find(request()->cookie('engine_id')))->name;
            return $year . ' ' . $make_name . ' ' . $model_name . ' ' . $engine_name;
        }


        return null;
    }


    public function heavy_item_lagos()
    {
        return $this->hasMany(ShippingRate::class)->where('is_lagos', true);
    }


    public function heavy_item_outside_lagos()
    {
        return $this->hasMany(ShippingRate::class)->where('is_lagos', false);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
