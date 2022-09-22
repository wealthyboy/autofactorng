<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;

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
        $featured_categories = Category::where('is_featured', true)->get();
        $categories = Category::parents()->get();
        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where('type','slider')->orderBy('sort_order','asc')->get();
        return view('index', compact('categories','brands','featured_categories','sliders'));
    }
}
