<?php

namespace App\Http\Controllers\Api\Years;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use Illuminate\Http\Request;

class YearsController extends Controller
{
    public function index(Request $request)
    {
        return Helper::years();
    }
}
