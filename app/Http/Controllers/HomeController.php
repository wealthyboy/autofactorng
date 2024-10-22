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

        sleep(60);
        $featured_categories = Category::where('is_featured', true)->get();
        $brands = Brand::where('is_featured', true)->get();
        $sliders = Banner::where(['type' => 'slider', 'device' => 'd-none d-lg-block d-xl-block'])->orderBy('sort_order', 'asc')->get();
        $top_banners = Banner::where(['type' => 'banner', 'sort_order' => 1])->get();
        $mobile_sliders = Banner::where(['type' => 'slider', 'device' => 'd-lg-none d-sm-block d-md-block'])->orderBy('sort_order', 'asc')->get();
        $products = Product::where('is_featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();


        $schema = [

            "@context" => "https://schema.org",
            "@graph" => [
                "@type" => "WebPage",
                "@id" => "https://autofactorng.com/",
                "url" => "https://autofactorng.com/",
                "name" => "Auto Parts Online Shop in Nigeria -Autofactorng ",
                "isPartOf" => [
                    "@id" => "https://autofactorng.com/#website"
                ],
                "about" => [
                    "@id" => "https://autofactorng.com/#organization"
                ],
                "primaryImageOfPage" =>  [
                    "@id" => "https://autofactorng.com/#primaryimage"
                ],
                "image" => [
                    "@id" => "https://autofactorng.com/#primaryimage"
                ],
                "thumbnailUrl" => "https://autofactorng.com/images/banners/KTh4is2SZMDnYT9AnrJI5qvDEoT3sK1DHumBSw7V.jpg",
                "datePublished" => "2019-03-25T12=>07=>23+00=>00",
                "dateModified" => "2022-08-08T09=>28=>42+00=>00",
                "description" => "We provide you with high quality Auto Parts for various vehicles and help you save money by offering you the lowest rates you can find.",
                "breadcrumb" =>  [
                    "@id" => "https://autofactorng.com/#breadcrumb"
                ],
                "inLanguage" => "en-US",
                "potentialAction" => [
                    "@type" => "ReadAction",
                    "target" => ["https://autofactorng.com/"]
                ]
            ], [
                "@type" => "ImageObject",
                "inLanguage" => "en-US",
                "@id" => "https://autofactorng.com/#primaryimage",
                "url" => "https://autofactorng.com/images/banners/KTh4is2SZMDnYT9AnrJI5qvDEoT3sK1DHumBSw7V.jpg",
                "contentUrl" => "https://autofactorng.com/images/banners/KTh4is2SZMDnYT9AnrJI5qvDEoT3sK1DHumBSw7V.jpg",
                "width" => 720,
                "height" => 700,
                "caption" => "Auto Parts MyParts Nigeria"
            ], [
                "@type" => "BreadcrumbList",
                "@id" => "https://autofactorng.com/#breadcrumb",
                "itemListElement" => [
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => "Home"
                ]
            ], [
                "@type" => "WebSite",
                "@id" => "https://autofactorng.com/#website",
                "url" => "https://autofactorng.com/",
                "name" => "MyParts Nigeria",
                "description" => "One Stop Auto Parts Website in Nigeria",
                "publisher" => [
                    "@id" => "https://autofactorng.com/#organization"
                ],
                "potentialAction" => [
                    "@type" => "SearchAction",
                    "target" => [
                        "@type" => "EntryPoint",
                        "urlTemplate" => "https://autofactorng.com/?q={search_term_string}"
                    ],
                    "query-input" => "required name=search_term_string"
                ],
                "inLanguage" => "en-US"
            ],
            [
                "@type" => "Organization",
                "@id" => "https://autofactorng.com/#organization",
                "name" => "MyParts Nigeria",
                "url" => "https://autofactorng.com/",
                "logo" => [
                    "@type" => "ImageObject",
                    "inLanguage" => "en-US",
                    "@id" => "https://autofactorng.com/#/schema/logo/image/",
                    "url" => "https://autofactorng.com/images/logo/autofactor_logo.png",
                    "contentUrl" => "https://autofactorng.com/images/logo/autofactor_logo.png",
                    "width" => 327,
                    "height" => 100,
                    "caption" => "Autofactorng"
                ],
                "image" => [
                    "@id" => "https://autofactorng.com/#/schema/logo/image/"
                ],
                "sameAs" => ["https://www.facebook.com/autofactorng/", "https://twitter.com/autofactorng/", "http://instagram.com/autofactorng/"]
            ]

        ];

        $schema = collect($schema);
        return view('index', compact('schema', 'top_banners', 'brands', 'featured_categories', 'sliders',  'mobile_sliders', 'products'));
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
        return view('test', compact('top_banners', 'brands', 'featured_categories', 'sliders',  'mobile_sliders', 'products'));
        // return view('test');
    }
}
