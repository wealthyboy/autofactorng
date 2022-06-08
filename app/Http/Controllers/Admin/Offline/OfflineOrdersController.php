<?php

namespace App\Http\Controllers\Admin\Offline;

use Illuminate\Http\Request;

use App\Order;
use App\User;
use App\Product;
use App\Cart;
use App\OrderedProduct;
use App\Http\Controllers\Controller;
use App\Mail\OfflineOrderMail;
use App\State;




class OfflineOrdersController extends Controller{ 


  
    public function __construct()
    {
       $this->middleware('admin'); 
	   $this->settings =  \DB::table('system_settings')->first();
    }

    public function index (Request $request ) { 
		$carts =  Cart::where('remember_token',\Cookie::get('cart'))->get();

        $order =  '';
        $products = Product::orderBy('created_at','desc')->get();
        $orders = Order::orderBy('created_at','desc')->get();
        if ($request->session()->has('order_id')) {
            $order = Order::find(session('order_id'));
            $total = OrderedProduct::sum_items_in_cart(session('order_id'));
		}
		$states = State::all();

        return view('admin.offline_orders.index',compact('carts','states','orders','products','total','order'));
	}

	public function show($id) { 
	   $orders = OfflineOrder::where('offline_order_address_id',$id)->get();
	   return view('admin.offline_orders.show',compact('orders'));
	}

	public function edit($id) { 
		$address = OfflineOrderAddress::find($id);
		$states = State::all();
		return view('admin.offline_orders.edit',compact('states','address'));
	 }

	public function create() { 
		$states = State::all();
		return view('admin.offline_orders.create',compact('states'));
	}

	public function invoice($id){
	  $address     =  OfflineOrderAddress::find($id);
	  $total  =  (new OfflineOrder())->items_total($id);
	  return view('account.sales.invoice.index',compact('total','address','page_title'));

	}

	public function update(Request $request,$id){

		if($request->isMethod('post')){

			$this->validate ( $request, [
				'name' => 'required',
				'last_name' => 'required',
				'quantity.*' => 'required|numeric',
				'prices.*' => 'required|numeric',
				'phone' => 'required',
				'address'=>'required',
				'city' => 'required',
				'state_id'=>'required'
			]);
			$ad   =  OfflineOrderAddress::find($id);
			$result    = $ad->update($request->only(['name','last_name','email','phone','address','address_2','city','state_id']));
			foreach ( $request->product_name as $key => $val) { 
				$ad->offline_orders()->updateOrCreate(
					['id'=>$key],
					['product_name'=>$request->product_name[$key],
					'size'=>$request->sizes[$key],
					'color'=>$request->colors[$key],
					'quantity'=>$request->quantity[$key],
					'total'=>(int)$request->prices[$key] * (int)$request->quantity[$key],
					'price'=>$request->prices[$key]]
				);			
			}
			$order   =  OfflineOrder::where('processed',false);
            if($order->count()){
				if($request->has('email')){
					$address = $ad;
					\Mail::to($request->email)
					->cc('teju@hautesignatures.com')
					->send(new OfflineOrderMail($address));
				}

				$order->update([
					'processed'=>true,
				]);
			}
			
			return \Redirect::to('/administration/sales/offline-orders');

	   }
	}

	public function store(Request $request,OfflineOrder $od,OfflineOrderAddress $oda){
		
		$flash = app('App\Http\Flash');

				if($request->isMethod('post')){
					$this->validate ( $request, [
						'name' => 'required',
						'last_name' => 'required',
						'phone' => 'required',
						'address'=>'required',
						'city' => 'required',
						'state_id'=>'required'
					]);
					// dd($request);
					$address = $oda->create($request->only(['name','last_name','email','phone','address','address_2','city','state_id']));
					
					foreach ( $carts   as $cart){
						$insert = [
						'order_id'=>$order->id,
						'product_id'=>$cart->product_id,
						'price'=>$cart->price,
						'size'=>$cart->size,
						'color'=>$cart->product_image->color->color_name,
						'quantity'=>$cart->quantity,
						'total'=>$cart->quantity * $cart->price,
						'created_at'=>\Carbon\Carbon::now()
				   ];
				  OrderedProduct::Insert($insert);

				$product = Product::find($cart->product_id);
				$product->update([
					'quantity'=>($product->quantity - $cart->quantity),
					'total'=>$product->price * ($product->quantity - $cart->quantity),	
				]); 
			}
			
			if(!empty($request->product_name)){
				foreach($request->product_name as $key => $val){
				  $od->product_name=$request->product_name[$key];
				  $od->quantity=$request->quantity[$key];
				  $od->size=$request->sizes[$key];
				  $od->price=$request->prices[$key];
				  $od->total=(int)$request->prices[$key] * (int)$request->quantity[$key] + (new State())->shipping_price();
				  $od->offline_order_address_id=$address->id;
				  $od->processed=1;
				  $od->save();
				}
                if(!empty($request->email)){
					$order = OfflineOrder::where('offline_order_address_id',$address->id)->get();
					\Mail::to($request->email)
					->cc('jacob.atam@gmail.com')
					->send(new OfflineOrderMail($address));
				}
			}
			$flash->success( "Success", "Order Created" );
			return \Redirect::to('/admin/sales/offline-orders');
		}
	}


	public function delete(Request $request)
    {
    	if ($request->isMethod ( 'post' )) {
    		$rules = array (
    				'_token' => 'required'
    		);
    		$validator = \Validator::make ( $request->all (), $rules );
    		if (empty ( $request->selected )) {
    			$validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
    			return \Redirect::back ()->withErrors ( $validator )->withInput ();
			}
			
    		OfflineOrderAddress::destroy( $request->selected );
    		$flash = app ( 'App\Http\flash' );
    		$flash->success ( "Success", "Deleted" );
    		return redirect()->back();
    	}
    }
	
	 



}