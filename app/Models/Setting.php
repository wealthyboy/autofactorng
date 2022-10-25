<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function alert_email()
    {
        return $this->alert_email;
    }

    public function logo_path()
    {
        return '/images/logo/' . $this->store_logo;
    }

    public function currency()
    {
        if ($this->customer_currency_id !== null) {
            // return  $this->belongsTo(Currency::class,'customer_currency_id');
        }
        //return  $this->belongsTo(Currency::class);

        return '₦';
    }


    public function default_currency()
    {
        // return  $this->belongsTo(Currency::class,'currency_id');
        return '₦';
    }
}
