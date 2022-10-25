<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class SortByFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        $sort = explode(',',$value);
        return $builder->orderBy($sort[0],$sort[1]);
    }
    
}
