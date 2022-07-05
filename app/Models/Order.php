<?php

namespace App\Models;

use App\Http\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    public $appends = ['ship_price'];

	public function ordered_products(){
	   return $this->hasMany(OrderedProduct::class);
	}

	public function user(){
	   return $this->belongsTo(User::class);	
	}

	public function address(){
		return $this->belongsTo(Address::class);	
	}

	public function shipping(){
		return $this->belongsTo(Shipping::class);	
	}

	public function getShipPriceAttribute(){
		return  $this->shipping_price ?? optional($this->shipping)->converted_price;
	}

	public  function voucher(){
		$voucher = Voucher::where('code',$this->coupon)->first();
		if(null !== $voucher ){
			return $voucher;
		}
		return false;
	}

	
	public function getCouponDiscount($amount) {
		if($this->voucher()){
			return	Helper::getPercentageDiscount($this->voucher()->amount, $amount);
		}
		return;
	}


	public static function all_sales($id=null) { 
        if($id){
            $total = static::select(\DB::raw('SUM(orders.total) as items_total'))->where('order_id',$id)->get();
            return 	$total = $total[0];
        } else {
            $total = static::select(\DB::raw('SUM(orders.total) as items_total'))->get();
            return 	$total = $total[0];
        }	
	}

	
	public function get_total(){
		if ($this->order_type == 'admin'){
			return number_format($this->total);
		}
		return number_format($this->total);
	}


	public  function shipfullname() { 
	   return ucfirst($this->ship_name) . ' '. ucfirst($this->ship_last_name);
	} 
}
