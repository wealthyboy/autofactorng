<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class PriceFromFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        return $builder->where('price','>=',$value);
    }
    
}
