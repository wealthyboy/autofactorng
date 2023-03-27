<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links =  [
            'light_duty',
            'normal_duty',
            'heavy_duty'
        ];

        switch (request()->plan) {
            case 'light_duty':
                $range1 = 50000;
                $range2 = 149000;
                break;
            case 'normal_duty':
                $range1 = 150000;
                $range2 = 349000;
                break;
            case 'heavy_duty':
                $range1 = 350000;
                $range2 = 750000;
                break;
            default:
                $range1 = null;
                $range2 = null;
                break;
        }

        if (!in_array(request()->plan, $links)) {
            abort(404);
        }

        session(['plan' => request()->plan]);

        $price_range = [
            $range1,
            $range2
        ];

        $user =  auth()->check() ?  true : false;
        return view('subscribe.index', compact('price_range', 'user'));
    }
}
