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

          $products = Product::where('slug', 'genuine-crankshaft-position-sensor-23731-ja10b')->get();

          foreach ($products as $product) {
               $path = $product->images[0]->image;
               $file = basename($path);
               $path = public_path('images/products/' . $file);
               $canvas = \Image::canvas(600, 600);

               $image  = \Image::make($path)->resize(600, 600, function ($constraint) {
                    $constraint->aspectRatio();
               });
               $canvas->insert($image, 'center');
               $canvas->save(
                    public_path('images/products/l/' . $file)
               );
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
