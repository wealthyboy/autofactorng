<?php

namespace App\Http\Controllers\Admin\Discounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountProduct;
use App\Models\Activity;
use App\Models\User;
use App\Http\Helper;
use Illuminate\Validation\Rule;



class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::parents()->get();
        return view('admin.discounts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=>'required|unique:discounts,category_id',
            'percentage_discount' =>'required',
            'expires'=>'required',
        ]);

        $discount = Discount::create([
            'category_id' => $request->category_id,
            'amount' => $request->percentage_discount,
            'expires'=> $request->expires
        ]);
        
        return redirect()->route('discounts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $discount = Discount::find($id);
        $categories = Category::parents()->get();
        return view('admin.discounts.edit',compact('categories','discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $discount = Discount::find($id);
        
        $this->validate($request,[
            'category_id'=>[
                'required',
                    Rule::unique('discounts')->ignore($id),   
            ],
            'percentage_discount' =>'required',
            'expires'=>'required',
        ]);
        $discount->category_id = $request->category_id;
        $discount->amount = $request->percentage_discount;
        $discount->expires = $request->expires;
        $discount->save();
        //Log Activity
        //(new Activity)->Log("Updated  Discount {$request->category_id} ");
        return redirect()->route('discounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //User::canTakeAction(5);

        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $count = count($request->selected);
        //(new Activity)->Log("Deleted  {$count} Products");
        Discount::destroy( $request->selected );

        return redirect()->back();
    }
}
