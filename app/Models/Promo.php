<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'bgcolor',
        'text_color',
        'accent_color',
        'title',
        'message',
        'cta_text',
        'cta_url',
        'coupon_percent',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'coupon_percent' => 'integer',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('global_promo');
        });

        static::deleted(function () {
            Cache::forget('global_promo');
        });
    }

    public function promo_texts()
    {
        return $this->hasMany(PromoText::class);
    }

    public function displayTitle(): string
    {
        $discount = (int) ($this->coupon_percent ?: 5);

        return str_replace(
            '{discount}',
            (string) $discount,
            $this->title ?: 'NEW CUSTOMER OFFER'
        );
    }

    public function displayMessage(): string
    {
        $discount = (int) ($this->coupon_percent ?: 5);

        return str_replace(
            '{discount}',
            (string) $discount,
            $this->message ?: 'Create an account and get {discount}% OFF your next order. Your personal coupon code will be emailed after registration.'
        );
    }
}
