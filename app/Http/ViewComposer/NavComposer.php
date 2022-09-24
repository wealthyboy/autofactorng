<?php  

namespace App\Http\ViewComposer;

use  App\User;
use Illuminate\View\View;

use Auth;
use App\Models\Cart;
use App\Models\Information;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Voucher;
use App\Models\Promo;


use Illuminate\Support\Facades\Cache;

class   NavComposer { 
   
   
    public function compose (View $view) 
	{ 
		$global_categories = Category::parents('sort_order', 'asc')->get();
		$footer_info = Information::parents()->get(); 
		$global_promo = Promo::first(); 
		$system_settings = Setting::first();
		//$news_letter_image = PageBanner::where('page_name','newsletter')->first();
	    $view->with([
		   	'footer_info'=>$footer_info,
		   	'global_categories'=> $global_categories,
			'system_settings'=>$system_settings,
			'global_promo'=>$global_promo,
	    ]);
    }




}