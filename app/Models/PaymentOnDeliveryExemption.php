<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOnDeliveryExemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim((string) $value));
    }

    public static function isExempt($email): bool
    {
        $email = strtolower(trim((string) $email));

        if ($email === '') {
            return false;
        }

        return static::query()->where('email', $email)->exists();
    }
}
