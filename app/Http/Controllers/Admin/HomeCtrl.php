<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Models\OrderedProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;





class HomeCtrl extends Controller
{

     protected $redirectTo = '/admin/login';

     /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct()
     {
          //$this->middleware('admin'); 
     }

     public function index()
     {
          $top_selling_product = OrderedProduct::select('product_id')
               ->groupBy('product_id')
               ->orderByRaw('COUNT(*) DESC')
               ->whereMonth('created_at', date('m'))
               ->with('product')
               ->first();

          //dd($top_selling_product);

          $stats = [];
          $stats['sales'] = 0;
          $stats['Customers'] = (new User())->customers()->count();
          // $stats['top_sells'] = 0;

          return view('admin.index', compact('stats'));
     }
}
