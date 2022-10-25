<?php

namespace App\Filters\OrderFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class StatusFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        return $builder->where('status',$value);
    }
    
}
