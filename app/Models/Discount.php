<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'amount',
        'expires'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
