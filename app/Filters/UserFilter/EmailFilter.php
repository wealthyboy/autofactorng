<?php

namespace App\Filters\UserFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class EmailFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        return $builder->where('email',$value);
    }
    
}
