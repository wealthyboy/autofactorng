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

        if (!in_array(request()->plan, $links)) {
            abort(404);
        }

        $subscribe = true;
        return view('subscribe.index', compact('subscribe'));
    }
}
