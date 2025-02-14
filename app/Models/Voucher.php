<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FormatPrice;

class Voucher extends Model
{
    use HasFactory, FormatPrice;

    protected $fillable = [
        'email',
        'code',
        'amount',
        'valid',
        'user_id'
    ];

    public $appends = [
        'currency',
        'from_price'
    ];

    protected $dates = ['expires'];

    public function expire()
    {
        $sp = explode(' ', $this->expires);
        return $sp[0];
    }

    public function format_back()
    {
        $exp = explode(' ', $this->expires);
        $exp = explode('-', $exp[0]);
        return $exp[2] . '/' . $exp[1] . '/' . $exp[0];
    }

    public static function inValidate($coupon)
    {
        if ($coupon) {
            $code = trim($coupon);
            $coupon =  Voucher::where('code', $coupon)->first();
            if (null !== $coupon && $coupon->type == 'specific user') {
                $coupon->update(['valid' => false]);
            }
        }
    }

    public function getFromPriceAttribute()
    {
        return number_format(
            $this->ConvertCurrencyRate($this->from_value),
            2
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'coupon', 'code');
    }


    public function is_coupon_expired()
    {
        if (!$this->expires->isFuture()) {
            return true;
        }
        return false;
    }


    public function is_valid()
    {
        return  $this->valid ? true : false;
    }

    public function getListingData($collection)
    {

        return  $collection->map(function ($voucher) {
            return [
                "Id" => $voucher->id,
                "Code" => $voucher->code,
                "Amount Percent" => $voucher->amount,
                "Rule From Amount" => $voucher->from_value,
                "Valid" => $voucher->valid == 0 ? 'USED' : 'YES',
                "Type" => $voucher->type,
                "Expires" => $voucher->expire(),
                "Date Added" => $voucher->created_at->diffForHumans(),
            ];
        });
    }

    public function sortKeys($key)
    {
        $sort =  [
            "Id" => 'id',
            "Code" => 'code',
            "Amount Percent" => 'amount',
            "Rule From Amount" => 'from_value',
            "Valid" => 'valid',
            "Type" => 'type',
            "Expires" => 'expires',
            "Date Added" => 'created_at',
        ];

        return $sort[$key];
    }
}
