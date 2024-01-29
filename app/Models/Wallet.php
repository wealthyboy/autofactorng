<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'status'
    ];

    public function getListingData($collection)
    {
        return  $collection->map(function (Wallet $wallet) {
            return [
                "Ref Id" => '#' . optional($wallet)->id,
                "Amount" => '₦' . number_format(optional($wallet)->amount),
                "Status" =>  optional($wallet)->status,
                "Date Added" => optional($wallet->created_at)->format('d-m-y')
            ];
        });
    }
}
