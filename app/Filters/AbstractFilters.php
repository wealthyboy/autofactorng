<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class  AbstractFilters
{
    //
    protected $request; 

    protected  $filters = [];
      
    public function __construct(Request $request){
       $this->request = $request;
    }

    public function filter(Builder $builder)
    {
        foreach($this->getFilters() as $filter => $value){
           $this->resolvefilters($filter)->filter($builder,$value);
        }
        return null; 
    }

    public function getFilters()
    {
        return $this->filterFilters($this->filters);
    }

    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters,$filters);
        return $this;
    }


    public function resolvefilters($filter){
        return new $this->filters[$filter];
    }

    public function filterFilters($filter){
        return array_filter($this->request->only(array_keys($this->filters))) ; 
    }
}
