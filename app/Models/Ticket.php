<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public const STATUSES = ['Open', 'In Progress', 'Resolved', 'Closed'];

    protected $fillable = ['ticket_number', 'order_id', 'reason', 'status', 'created_by'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
