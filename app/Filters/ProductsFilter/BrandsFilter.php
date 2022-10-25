<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class BrandsFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        return  $builder->whereHas('brand',function(Builder  $builder) use ($value){
            $builder->whereIn('brand_name' ,$value);
        }); 
    }  
}
