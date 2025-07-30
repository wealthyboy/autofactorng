<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    use HasFactory;

    protected $casts = [
        'cart_items' => 'array',
        'checkout_started_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'cart_items',
        'checkout_started_at',
        'recovered',
    ];
}
