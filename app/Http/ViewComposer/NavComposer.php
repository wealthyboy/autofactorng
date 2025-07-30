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
        $global_categories = Cache::remember('global_categories', now()->addMinutes(30), function () {
            return Category::parents('sort_order', 'desc')->get();
        });

        // Cache footer info for 30 minutes
        $footer_info = Cache::remember('footer_info', now()->addMinutes(30), function () {
            return Information::with('children')->parents()->get();
        });

        // Cache promo for 30 minutes
        $global_promo = Cache::remember('global_promo', now()->addMinutes(30), function () {
            return Promo::first();
        });

        // Cache settings for 5 minutes (shorter in case it changes often)
        $system_settings = Cache::remember('system_settings', now()->addMinutes(5), function () {
            return Setting::first();
        });

        $yrs = json_encode(Helper::years());

        $user = auth()->check() ? auth()->user() : 0000;

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
