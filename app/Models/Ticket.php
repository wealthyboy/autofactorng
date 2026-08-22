<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public const STATUSES = ['Open', 'In Progress', 'Resolved', 'Closed'];
    public const DEPARTMENTS = ['Accounts', 'Procurement/Operations', 'Management', 'Logistics'];
    public const REASONS = ['Delayed Delivery', 'Wrong Item Delivered', 'Defective Item', 'No Delivery', 'Customer no longer interested'];
    public const CATEGORIES = ['Escalation', 'Refund', 'Wallet'];
    public const WALLET_SOURCES = ['Online', 'Offline'];

    protected $fillable = [
        'ticket_number',
        'order_id',
        'department',
        'reason',
        'category',
        'status',
        'return_total',
        'account_name',
        'account_number',
        'bank_name',
        'wallet_source',
        'created_by',
    ];

    protected $casts = [
        'return_total' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function items()
    {
        return $this->hasMany(TicketItem::class);
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
