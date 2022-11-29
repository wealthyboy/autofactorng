<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletBalance extends Model
{
    use HasFactory;

    public static function deductFromWallet($amount)
    {
        $wallet = new Wallet();
        $wallet->amount = $amount;
        $wallet->user_id = auth()->user()->id;
        $wallet->status = 'Removed';
        $wallet->save();

        $balance = self::where('user_id', auth()->user()->id)->first();
        $balance->balance =  $balance->balance - $amount;
        $balance->save();
        return $balance;
    }


    public static function deductFromCredit($amount)
    {
        $wallet = new Wallet();
        $wallet->amount = $amount;
        $wallet->user_id = auth()->user()->id;
        $wallet->status = 'Removed';
        $wallet->save();

        $balance = self::where('user_id', auth()->user()->id)->first();
        $balance->auto_credit =  $balance->auto_credit - $amount;
        $balance->save();
        return $balance;
    }
}
