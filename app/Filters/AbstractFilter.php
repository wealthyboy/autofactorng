<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class  AbstractFilter
{
    //
    protected $request; 

      
    abstract public function filter(Builder $builder,$value);
    
    public function mappings(){
        return [
           
        ];
    }
}
