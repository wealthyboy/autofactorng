<?php

namespace App\Http\Controllers\Admin\Shipping;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Activity;
use App\Models\User;
use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use Illuminate\Validation\Rule;




class ShippingController extends Table
{

    public $deleted_names = 'name';

    public $deleted_specific = 'shipping';

    public function builder()
    {
        return Shipping::query();
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
        return view('admin.shipping.index', compact('locations', 'shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
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

        $shipping = new Shipping;
        $shipping->name = $request->name;
        $shipping->price = $request->price;
        $shipping->location_id = $request->location_id;
        $shipping->parent_id     = $request->parent_id;
        $shipping->save();
        (new Activity)->put("Added a shipping for  " . optional($shipping->location)->name);
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
        User::canTakeAction(User::can);

        $shipping = Shipping::find($id);
        $shippings = Shipping::parents()->get();
        $locations = Location::parents()->get();
        return view('admin.shipping.edit', compact('locations', 'shipping', 'shippings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        (new Activity)->put("Updated shipping for " . optional($shipping->location)->name);

        return redirect()->action('Admin\Shipping\ShippingController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
}
