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
        $user  = User::where('email' , 'damilola@autofactorng.com')->first();
        if (null !== $user) {
            $message = "This is a reminder to let you know that your auto credit plan expires in 30 days.";
         
                \Notification::route('mail', optional($user)->email)
                    ->notify(new \ReminderNotification($user, 30));
            
        }

        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where(['type' => 'slider', 'device' => 'd-none d-lg-block d-xl-block'])->orderBy('sort_order', 'asc')->get();
        $mobile_sliders = Banner::where(['type' => 'slider', 'device' => 'd-lg-none d-sm-block d-md-block'])->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();
        return view('index', compact('categories', 'brands', 'featured_categories', 'sliders',  'mobile_sliders', 'products'));
    }
}
