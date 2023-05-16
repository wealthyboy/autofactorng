<?php

namespace App\Http\ViewComposer;

use App\Http\Helper;
use App\Models\User;
use Illuminate\View\View;

use Auth;
use App\Models\Information;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Promo;


use Illuminate\Support\Facades\Cache;

class   NavComposer
{


	public function compose(View $view)
	{
		$global_categories = Category::parents('sort_order', 'desc')->get();
		$footer_info = Information::with('children')->parents()->get();
		$global_promo = Promo::first();
		$system_settings = Setting::first();
		$yrs = collect(Helper::years());
		$user = auth()->check() ? auth()->user() : 0000;

		//$news_letter_image = PageBanner::where('page_name','newsletter')->first();
		$view->with([
			'footer_info' => $footer_info,
			'global_categories' => $global_categories,
			'system_settings' => $system_settings,
			'global_promo' => $global_promo,
			'yrs' => $yrs,
			'user' => $user
		]);
	}
}
