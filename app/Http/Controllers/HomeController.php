<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationComplete;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Notifications\ReminderNotification;
use App\Models\BrandCategory;
use App\Models\Subscribe;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $featured_categories = Category::where('is_featured', true)->get();
        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where(['type' => 'slider', 'device' => 'd-none d-lg-block d-xl-block'])->orderBy('sort_order', 'asc')->get();
        $top_banners = Banner::where(['type' => 'banner', 'sort_order' => 1])->get();
        $mobile_sliders = Banner::where(['type' => 'slider', 'device' => 'd-lg-none d-sm-block d-md-block'])->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();
        return view('index', compact('top_banners', 'brands', 'featured_categories', 'sliders',  'mobile_sliders', 'products'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test()
    {


        $featured_categories = Category::where('is_featured', true)->get();
        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where(['type' => 'slider', 'device' => 'd-none d-lg-block d-xl-block'])->orderBy('sort_order', 'asc')->get();
        $top_banners = Banner::where(['type' => 'banner', 'sort_order' => 1])->get();
        $mobile_sliders = Banner::where(['type' => 'slider', 'device' => 'd-lg-none d-sm-block d-md-block'])->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();
        // return view('test', compact('top_banners', 'brands', 'featured_categories', 'sliders',  'mobile_sliders', 'products'));
        return view('test');
    }
}
