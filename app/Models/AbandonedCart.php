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
        'recovered' => 'boolean',
        'reminder_sent_at' => 'datetime',
        'recovered_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'cart_token',
        'checkout_started_at',
        'recovered',
        'reminder_sent_at',
        'recovered_at',
        'cart_items',
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
