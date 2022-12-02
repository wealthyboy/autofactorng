<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;


    public function getListingData($collection)
    {
        return  $collection->map(function (Wallet $wallet) {
            return [
                "Ref Id" => '#' . optional($wallet)->id,
                "amount" => '₦' . number_format(optional($wallet)->amount),
                "status" =>  optional($wallet)->status,
                "date_added" => $wallet->created_at->format('d-m-y')
            ];
        });
    }
}
