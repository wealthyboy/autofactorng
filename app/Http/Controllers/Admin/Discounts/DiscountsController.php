<?php

namespace App\Http\Controllers\Admin\Discounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Discount;
use App\DiscountProduct;
use App\Http\Helper;
use Illuminate\Validation\Rule;
use App\Activity;
use App\User;


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

        $products = Category::find($request->category_id)->products;
        $discount = Discount::create([
            'category_id' => $request->category_id,
            'percentage_off' => $request->percentage_discount,
            'expires'=> Helper::getFormatedDate($request->expires)
        ]);
        foreach ($products as $product) {
            $sale_price = Helper::getPercentageDiscount($request->percentage_discount,$product->price);
            $discount->discount_products()->create([
                'product_id' => $product->id,
                'sale_price' => $sale_price,
            ]);
        }
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
        //
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
        $discount->percentage_off = $request->percentage_discount;
        $discount->expires = Helper::getFormatedDate($request->expires);
        $discount->save();
        //Log Activity
        (new Activity)->Log("Updated  Discount {$request->category_id} ");
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
        User::canTakeAction(5);

        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $count = count($request->selected);
        (new Activity)->Log("Deleted  {$count} Products");
        Discount::destroy( $request->selected );

        DiscountProduct::whereIn('discount_id',$request->selected)->delete();
        return redirect()->back();
        

        // $category =  Discount::find( $request->id );
        // (new Activity)->Log("Deleted  {$category->name} Discounts");
        // $category->delete();
        // return redirect()->back();
    }
}
