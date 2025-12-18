<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_name',
        'action',
        'user_email',
        'old_quantity',
        'new_quantity',
    ];
}
