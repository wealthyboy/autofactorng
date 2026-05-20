<?php

namespace App\Services;

use App\Models\User;
use App\Models\Voucher;

class InDriveCouponService
{
    public const CODE = 'InDrive';

    public function isInDriveUser(?User $user): bool
    {
        return (bool) optional($user)->is_indrive_customer || (bool) session('is_indrive_customer');
    }

    public function isProtectedCoupon(?string $code): bool
    {
        return strcasecmp(trim((string) $code), self::CODE) === 0;
    }

    public function voucher(): ?Voucher
    {
        return Voucher::query()
            ->whereRaw('LOWER(code) = ?', [strtolower(self::CODE)])
            ->where('status', 1)
            ->first();
    }

    public function applyToSubtotal(float $subtotal): array
    {
        $voucher = $this->voucher();

        if (! $voucher || ! $this->canApply($voucher, $subtotal)) {
            return [
                'code' => null,
                'voucher' => null,
                'discount' => 0,
                'subtotal' => $subtotal,
                'label' => null,
            ];
        }

        $discount = $voucher->is_fixed
            ? (float) $voucher->amount
            : ((float) $voucher->amount * $subtotal) / 100;

        $discount = min($discount, $subtotal);

        return [
            'code' => $voucher->code,
            'voucher' => $voucher,
            'discount' => $discount,
            'subtotal' => $subtotal - $discount,
            'label' => $voucher->is_fixed
                ? '-' . number_format($discount, 0) . ' Value Deducted'
                : $voucher->amount . '% percent off',
        ];
    }

    protected function canApply(Voucher $voucher, float $subtotal): bool
    {
        if ($voucher->expires && ! $voucher->expires->isFuture()) {
            return false;
        }

        if (isset($voucher->valid) && ! $voucher->valid) {
            return false;
        }

        if ($voucher->from_value && $subtotal < (float) $voucher->from_value) {
            return false;
        }

        return true;
    }
}
