<?php

namespace App\Http\Controllers;

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
       $cats =  [
           'Engine Oil'   => 'https://www.autozone.com/cdn/images/B2C/US/media/FY21/P05/fy21p0506-grid4-engine-oil-d.jpg',
           'Oil Filter'   => 'https://www.autozone.com/cdn/images/B2C/US/media/FY21/P05/fy21p0506-grid4-oil-filter-d.jpg',
           'Brake Pads'   => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-Pads-v2-d.jpg',
           'Brake Rotors' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-rotors-d.jpg',
           'Batteries'       => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-batteries-d.jpg',
           'L & G Batteries' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-LGBatteries-d.jpg',
           'Spark Plugs' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-sparkplugs-d.jpg',
           'O2 sensors'     => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-O2-sensors-d.jpg',
           'Wash & Wax' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-washWax-d.jpg',
           'Wipers' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-wipers-d.jpg',
           'Towing' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-towingHitches-d.jpg',
           'AC Chemicals' => 'https://www.autozone.com/cdn/images/B2C/US/media/content/FeatCat/evergreen-grid4-ac-chemicals-d.jpg'
        ];
        return view('index', compact('cats'));
    }
}
