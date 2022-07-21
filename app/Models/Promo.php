<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bgcolor'
    ];

    public function promo_texts(){
        return $this->hasMany(PromoText::class);
    }
    
}
