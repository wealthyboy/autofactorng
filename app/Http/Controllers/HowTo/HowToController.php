<?php

namespace App\Http\Controllers\HowTo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class HowToController extends Controller
{
    public function index()
    {
        $videos  = Blog::paginate(10);
        return view('howto.index', compact('videos'));
    }
}
