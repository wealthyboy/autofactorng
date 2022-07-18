<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasChildren;


class Location extends Model
{
    use HasFactory, HasChildren;

    public function children()
    {
        return $this->hasMany(Location::class,'parent_id','id');
    }
}
