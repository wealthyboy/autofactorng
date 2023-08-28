<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class TotalFilter  extends AbstractFilter
{
    public function filter(Builder $builder, $value)
    {
        foreach ($value as $v) {
            $value = explode('-', $v);
            return  $builder->where('price', '>=', $value[0])
                ->where('price', '<=', $value[1]);
        }
    }
}
