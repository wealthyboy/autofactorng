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
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;




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
        $categories = Category::parents()->get();
        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where('type', 'slider')->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();
        //dd(str_replace('/', '-', '23/09/2016'));






        return view('index', compact('categories', 'brands', 'featured_categories', 'sliders', 'products'));
    }
}
