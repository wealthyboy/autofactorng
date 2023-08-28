<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasChildren;


class Shipping extends Model
{
    use HasFactory, HasChildren;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    public function locations()
    {
        return $this->belongsToMany(Shipping::class);
    }
}
