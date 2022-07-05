<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function scopeSliders(Builder $builder){
        return $builder->where('slider',true)->orderBy('sort_order','asc');
    }

    public function scopeBanners(Builder $builder){
        return $builder->orderBy('sort_order','asc');
    }

    public function image_path(){
        return asset('image/banners/'.$this->image);
     }
}
