<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren 
{
    
    public function scopeParents(Builder $builder,$order = null, $desc = null){

        if ($order == null){
           return $builder->whereNull('parent_id');
        }
        return $builder->whereNull('parent_id')->orderBy($order,$desc);
    }

    public function isParent()
    {
        return $this->parent_id == null ? true : false;
    }

}
