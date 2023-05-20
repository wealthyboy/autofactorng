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
        $mobile_sliders = Banner::where(['type' => 'slider', 'device' => 'd-lg-none d-sm-block d-md-block'])->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();

        $message = [];
        $subject =  "Your Subscription in 14 days";
        $user = User::where('email', 'jacob.atam@gmail.com')->first();

            //foreach ($subscribers as  $subscriber) {
                $date = $user->created_at->addDay()->format('d/m/y');
                $message[] = "Your Autocover subscription is expiring in 30 days! ";
                $message[] = "It's important to note that any unused credits or benefits after the expiry of the validity period cannot be rolled over or transferred. ";
                $message[] = "You shall be able to renew your subscription from {$date}";
                $message[] = "Renew to continue enjoying exclusive benefits.";
                $message[] = "Don't miss out on the convenience, savings, and perks of being a loyal subscriber.";
                \Notification::route('mail', optional($user)->email)
                    ->notify(new ReminderNotification($user, $message, $subject));
           // }

        return view('index', compact('brands', 'featured_categories', 'sliders',  'mobile_sliders', 'products'));
    }
}
