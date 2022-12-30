<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory, ColumnFillable;

    public function product()
    {
        return $this->belongsTo(Product::class, 'related_id');
    }
}
