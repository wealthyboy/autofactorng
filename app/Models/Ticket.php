<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public const STATUSES = ['Open', 'In Progress', 'Resolved', 'Closed'];
    public const DEPARTMENTS = ['Accounts', 'Procurement/Operations', 'Management', 'Logistics', 'Customer Support'];
    public const REASONS = ['Delayed Delivery', 'Wrong Item Delivered', 'Defective Item', 'No Delivery', 'Customer no longer interested', 'Over Payment', 'Double Payment'];
    public const CATEGORIES = ['Escalation', 'Refund', 'Wallet'];
    public const WALLET_SOURCES = ['Online', 'Offline'];
    public const APPROVAL_STATUSES = ['Pending', 'Not Approved', 'Approved'];

    protected $fillable = [
        'ticket_number',
        'order_id',
        'department',
        'reason',
        'category',
        'additional_information',
        'status',
        'return_total',
        'account_name',
        'account_number',
        'bank_name',
        'wallet_source',
        'approval_status',
        'approved_at',
        'approved_by',
        'created_by',
    ];

    protected $casts = [
        'return_total' => 'decimal:2',
        'approved_at' => 'datetime',
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

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function requiresPaymentApproval(): bool
    {
        return $this->category === 'Wallet'
            || $this->category === 'Refund'
            || in_array($this->reason, ['Over Payment', 'Double Payment'], true);
    }

    public function paymentApprovalStatus(): string
    {
        if (! $this->requiresPaymentApproval()) {
            return 'Not required';
        }

        if (in_array($this->approval_status, self::APPROVAL_STATUSES, true)) {
            return $this->approval_status;
        }

        return $this->approved_at ? 'Approved' : 'Pending';
    }

    public function usesCustomAmount(): bool
    {
        return $this->category === 'Wallet'
            || in_array($this->reason, ['Over Payment', 'Double Payment'], true)
            || $this->category === 'Refund';
    }
}

