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

          $users = array(
               array('id' => '236', 'first_name' => 'abiodun', 'last_name' => 'bakare', 'email' => 'bakerbiodun@yahoo.com', 'phone' => '08107803599', 'address' => 'access bank maryland mobolaji bank anthony', 'state_id' => '25', 'city' => '', 'landmark' => 'opposite military cantonment ikj', 'username' => 'abiodunbakare', 'password' => '66abc2252d92c68556946b210d12be64b289e9a8', 'is_verified' => '1', 'date_time' => '0000-00-00 00:00:00', 'token' => NULL),
               array('id' => '237', 'first_name' => 'Bola', 'last_name' => 'Dairo', 'email' => 'Omoboladairo@gmail.com', 'phone' => '08063189055', 'address' => '5', 'state_id' => '25', 'city' => 'Divine Avenue', 'landmark' => 'Oterubi Ogidan', 'username' => 'Mobeebah', 'password' => 'db6de8623677366a62afd1a1594c6becb549e9e7', 'is_verified' => '1', 'date_time' => '0000-00-00 00:00:00', 'token' => NULL),
          );



          foreach ($users as $user) {

               $u = new User;
               $u->id = $user['id'];
               $u->name = $user['first_name'];
               $u->last_name = $user['last_name'];
               $u->email = $user['email'];
               $u->phone_number =  $user['phone'];
               // $user->address = $user[];
               // $user->state_id = $user[];
               // $user->landmark =  $user[];
               $u->password =  bcrypt($user['password']);
               $u->old_password = $user['password'];
               $u->is_verified =  1;
               $u->created_at =  now();
               $u->is_old = 1;
               $u->type = 'subscriber';
               $u->save();
          }


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
