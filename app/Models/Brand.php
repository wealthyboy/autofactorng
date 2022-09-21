<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name','image', 'is_featured'];

    public function link()
    {
        return '/products/'. $this->slug;
    }

}
