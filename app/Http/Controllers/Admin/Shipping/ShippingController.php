<?php

namespace App\Http\Controllers\Admin\Shipping;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Activity;
use App\Models\User;
use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use Illuminate\Validation\Rule;




class ShippingController extends Controller
{
    
    public function __construct()
    {
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //$s = Shipping::find(274)->delete();
        $shippings = Shipping::parents()->get();
        $locations = Location::parents()->get();
        return view('admin.shipping.index',compact('locations','shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //User::canTakeAction(2);
        return view('admin.shipping.create');
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   


    public function store(Request $request)
    {   
         //
        
       
        $shipping = new Shipping;
        $shipping->name = $request->name;
        //$shipping->description = $request->description;
        $shipping->price = $request->price;
        $shipping->location_id = $request->location_id;
       // $shipping->sort_order=$request->sort_order;
        $shipping->parent_id     = $request->parent_id;
        $shipping->save();

        //$shipping->locations()->sync([$request->location_id]);

       // (new Activity)->Log("Created a new Shipping called {$request->name}");
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       // User::canTakeAction(4);

       $shipping = Shipping::find($id);
       $shippings = Shipping::parents()->get();
       $locations = Location::parents()->get();
        return view('admin.shipping.edit',compact('locations','shipping','shippings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        $shipping = Shipping::find($id);
       

        // $this->validate($request,[
        //     'name'=>[
        //         'required', 
        //         ],
        // ]);

        $shipping->name        = $request->name;
       // $shipping->description = $request->description;
        $shipping->price       = $request->price;
        $shipping->location_id = $request->location_id;
       // $shipping->sort_order  = $request->sort_order;
         $shipping->parent_id   = $request->parent_id;
        $shipping->save();
        //Log Activity
       // (new Activity)->Log("Updated  Shipping {$request->name} ");
        return redirect()->action('Admin\Shipping\ShippingController@index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
       // User::canTakeAction(5);
        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }

        $count = count($request->selected);
       // (new Activity)->Log("Deleted  {$count} Products");
        Shipping::destroy( $request->selected );
        return redirect()->back();
     
    }
}
