<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockSnapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'source',
        'product_id',
        'name',
        'quantity',
    ];
}
