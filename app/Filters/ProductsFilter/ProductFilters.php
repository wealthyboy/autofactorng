<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilters;
use App\Filters\ProductsFilter\CategoryFilter;
use App\Filters\ProductsFilter\PriceFromFilter;
use App\Filters\ProductsFilter\PriceToFilter;
use App\Filters\ProductsFilter\TotalFilter;
use App\Filters\ProductsFilter\AttributesFilter;
use App\Filters\ProductsFilter\BrandsFilter;
use App\Filters\ProductsFilter\SortByFilter;







class ProductFilters extends AbstractFilters
{
    
    protected $filters = [
        'category'=>CategoryFilter::class,
        'price_from'=>PriceFromFilter::class,
        'price_to'=>PriceToFilter::class, 
        'sort_by'=>SortByFilter::class,
        'prices' => TotalFilter::class,
        'brands' => BrandsFilter::class,
        'strap_type' =>AttributesFilter::class,
        'hprices' => PriceFromFilter::class
    ];

    
    
}
