<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'ordered_product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function orderedProduct()
    {
        return $this->belongsTo(OrderedProduct::class);
    }
}
