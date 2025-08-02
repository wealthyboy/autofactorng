<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    use HasFactory;

    protected $casts = [
        'checkout_started_at' => 'datetime',
        'cart_items' => 'array',

    ];

    protected $fillable = [
        'user_id',
        'checkout_started_at',
        'recovered',
      
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function abandoned_cart_items()
    {
        return $this->hasMany(AbandonedCartItem::class);
    }

    public function items()
    {
        return $this->hasMany(AbandonedCartItem::class, 'abandoned_cart_id');
    }
}
