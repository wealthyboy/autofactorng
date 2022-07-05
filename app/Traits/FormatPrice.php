<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Setting;
use App\Http\Helper;
use App\Models\CurrencyRate;



trait FormatPrice 
{

    
    protected $setting;


    public function __construct(){
	   	$this->setting = Setting::first();
    }
    
    /***
     * Returns the sale price of a product
     */
    public function formatted_discount_price()
    {
      //is future checks if the date is the future
      if ( $this->product_type == 'variable' && optional(optional($this->variant)->sale_price_expires)->isFuture() ) {
            return  null !== $this->variant  &&  null !== $this->variant->sale_price 
          ? $this->ConvertCurrencyRate($this->variant->sale_price)
          : null;
      } else {
          return null !== optional($this->default_variation)->sale_price  &&  optional(optional($this->default_variation)->sale_price_expires)->isFuture()  
          ? $this->ConvertCurrencyRate(optional($this->default_variation)->sale_price)
          : null;
      }
      return null;
    }

    public function display_price(){
      
      if ($this->formatted_discount_price() !== null) {
        if (  $this->product_type == 'variable') {
          echo "<i style='text-decoration: line-through;'>" . optional($this->variant)->price. "</i>" .'  '. optional($this->variant)->sale_price; 
        } else {
          echo  "<i style='text-decoration: line-through;'>" . $this->default_variation->price. "</i>" .'  '. $this->default_variation->sale_price; 
        }
      } else {
        if (  $this->product_type == 'variable') {
          echo  optional($this->variant)->price;
        }
        echo  $this->price; 
      }
    }


    public function getDefaultPercentageOffAttribute(){      
      return $this->calPercentageOff($this->price,$this->sale_price);
    }

    public function percentageOff(){
      return $this->calPercentageOff($this->price,$this->sale_price);
    }

    public function calPercentageOff($price,$sale_price){
      if (!empty($price) && !empty($sale_price)){
        $discount = (($price - $sale_price) * 100) / $price ;
        return round($discount); 
      }
      return null;
    }

    public function getPercentageOffAttribute(){      
      return $this->percentageOff();
    }

    public function getDiscountedPriceAttribute(){
      return $this->salePrice();

    }

    public function getCustomerPriceAttribute(){
      return $this->discounted_price ?? $this->converted_price ;
    }


    public function salePrice()
    {

      if ( null !== $this->sale_price  && null !== $this->sale_price_starts ) {
        if ( optional($this->sale_price_starts)->isPast()   || $this->sale_price_starts->isToday() ) { 
          if ( optional($this->sale_price_expires)->isFuture() &&  !optional($this->sale_price_starts)->isFuture()) { 
            return $this->ConvertCurrencyRate($this->sale_price);
          }
        }
      }
      

      // if ( null !== $this->sale_price  && null !== $this->sale_price_starts  ) {
      //     if ( optional($this->sale_price_expires)->isFuture() ) { 
      //       return $this->ConvertCurrencyRate($this->sale_price);
      //     }
      // }

      return null;

    }
  
    public function getDefaultDiscountedPriceAttribute(){
      
      return $this->salePrice();
    }

    public function getCurrencyAttribute(){
      $rate = Helper::rate();
      if ($rate){
         return $rate->symbol;
      }
		  return $this->setting->currency->symbol;
    }

    public function getConvertedPriceAttribute(){
     return  $this->ConvertCurrencyRate($this->price);   
    }
    
    public function ConvertCurrencyRate($price){
      
      $rate = Helper::rate();
      if ($rate){
        return round(($price * $rate->rate),0);  
      }
      return round($price,0);  

    }

}
