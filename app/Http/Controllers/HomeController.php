<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;

use App\Models\Product;
use Illuminate\Http\Request;

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



        /// dd(\Schema::getColumnListing('users'));

        // return redirect('/');
        $featured_categories = Category::where('is_featured', true)->get();
        $categories = Category::parents()->get();
        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where('type', 'slider')->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();

        return view('index', compact('categories', 'brands', 'featured_categories', 'sliders', 'products'));
    }
}
