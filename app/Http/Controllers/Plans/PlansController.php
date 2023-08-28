<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request()->type;
        $plans = $this->plansData();
        return view('plans.index', compact('type', 'plans'));
    }


    public function plansData()
    {
        return [
            'LIGHT DUTY' => [
                'title' => 'AUTO PARTS COVER SUBSCRIPTION PREMIUM',
                'price' => '₦50,000 - ₦149,000',
                'text' => [
                    '10% extra bonus credit',
                    'One free diagnosis within validity period',
                    'Keep track of your purchase history',
                    'Access to tons of vehicle repair guides',
                    'Get exclusive deals and offers',
                ]
            ],
            'NORMAL DUTY' => [
                'title' => 'AUTO PARTS COVER SUBSCRIPTION PREMIUM',
                'price' => '₦150,000 - ₦349,000',
                'text' => [
                    '10% extra bonus credit',
                    'Three free diagnosis within validity period',
                    'Keep track of your purchase history',
                    'Access to tons of vehicle repair guides',
                    'Get exclusive deals and offers',
                ]
            ],
            'HEAVY DUTY' => [
                'title' => 'AUTO PARTS COVER SUBSCRIPTION PREMIUM',
                'price' => '₦350,000 and Above',
                'text' => [
                    '10% extra bonus credit',
                    'One free towing service within lagos',
                    'Five free diagnosis within validity period',
                    'Keep track of your purchase history',
                    'Access to tons of vehicle repair guides',
                    'Get exclusive deals and offers',
                ]
            ]
        ];
    }
}
