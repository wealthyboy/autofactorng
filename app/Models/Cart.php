<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FormatPrice;
use App\Http\Helper;



class Cart extends Model
{

    protected $table = 'carts';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'user_id',
        'remember_token',
        'quantity',
        'total',
        'price',
        'make',
        'model',
        'year',
        'engine',
    ];

    public $appends = [
        'sub_total',
        'converted_price',
        'customer_price',
        'cart_total'
    ];



    public static function all_items_in_cart()
    {
        //SELECT ALL FROM THE USER ID && FROM THE USER COOKIE
        $cookie = \Cookie::get('cart');
        $carts = Cart::with(["product"])->where(['carts.remember_token' => $cookie])->get();
        static::sync($carts);


        if (optional(auth()->user())->id) {
            $carts = Cart::with(["product"])->where(['user_id' => optional(auth()->user())->id])->get();
            static::sync($carts);
        } else {
            $carts = Cart::with(["product"])->where(['carts.remember_token' => $cookie])->get();
            static::sync($carts);
        }
        return $carts;
    }


    public static function items_in_cart()
    {
        //SELECT ALL FROM THE USER ID && FROM THE USER COOKIE
        $cookie = \Cookie::get('cart');
        $carts = Cart::with(["product"])->where(['carts.remember_token' => $cookie, 'carts.quantity', '>=', 1])->get();
        static::sync($carts);
        return $carts;
    }

    public  static function sync($carts)
    {
        if (null == $carts) return null;

        $cookie = \Cookie::get('cart');


        foreach ($carts as $cart) {

            if (null == $cart->product) {
                $cart->delete();
            }

            if (!$cart->user_id) {
                $cart->update([
                    'user_id' => optional(auth()->user())->id,
                ]);
            }

            $cart->update([
                'remember_token' => null !== $cookie ? $cookie : $cart->remember_token
            ]);
        }
    }


    public  static function hide($carts)
    {
        if (null == $carts) return null;

        foreach ($carts as $cart) {

            $cart->update([
                'remember_token' => null
            ]);
        }
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }



    public static function sum_items_in_cart()
    {
        $cookie = \Cookie::get('cart');
        $total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('remember_token', $cookie)->get();


        if (optional(auth()->user())->id) {
            $total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('user_id', optional(auth()->user())->id)->get();
        } else {
            $total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('remember_token', $cookie)->get();
        }
        return     $total = $total[0]->items_total;
    }

    public static function cart_number()
    {
        $cookie = \Cookie::get('cart');
        $number_products_in_cart = \DB::table('carts')->select('carts.*')->where('remember_token', $cookie)->count();
        return $number_products_in_cart;
    }



    public static function ConvertCurrencyRate($price)
    {

        $rate = Helper::rate();
        if ($rate) {
            return round(($price * $rate->rate), 0);
        }
        return round($price, 0);
    }

    public static function delete_items_in_cart_purchased()
    {
        $cookie = \Cookie::get('cart');
        $delete_cart = \DB::table('carts')->select('carts.*')->where('remember_token', $cookie)->delete();
        return $delete_cart;
    }

    public function getCustomerPriceAttribute()
    {
        return $this->converted_price;
    }

    public function getConvertedPriceAttribute()
    {
        return static::ConvertCurrencyRate($this->price);
    }

    public function getCartTotalAttribute()
    {
        return  static::ConvertCurrencyRate($this->total);
    }

    public function getSubTotalAttribute()
    {
        return  static::ConvertCurrencyRate(static::sum_items_in_cart());
    }
}
