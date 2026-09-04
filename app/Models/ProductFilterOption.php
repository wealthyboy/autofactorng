<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilterOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_filter_group_id',
        'name',
        'slug',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function group()
    {
        return $this->belongsTo(ProductFilterGroup::class, 'product_filter_group_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_filter_option_product')
            ->withTimestamps();
    }
}
