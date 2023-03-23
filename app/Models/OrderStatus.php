<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory, ColumnFillable;

    public $appends = ['formated_date'];

    public function getFormatedDateAttribute()
    {
        return $this->created_at->format('d/m/y');
    }
}
