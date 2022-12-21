<?php

namespace App\Http\Controllers\Admin\Discounts;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountProduct;
use App\Models\Activity;
use App\Models\User;
use App\Http\Helper;
use Illuminate\Validation\Rule;



class DiscountsController extends Table
{

    public $deleted_names = 'title';

    public $deleted_specific = 'banners';

    public function builder()
    {
        return Discount::query();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        $categories = Category::parents()->get();
        return view('admin.discounts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|unique:discounts,category_id',
            'percentage_discount' => 'required',
            'expires' => 'required',
        ]);

        $discount = Discount::create([
            'category_id' => $request->category_id,
            'amount' => $request->percentage_discount,
            'expires' => $request->expires
        ]);

        (new Activity)->put("Added a discount with id  " . $discount->id . 'and amount' . $discount->amount);


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
        User::canTakeAction(User::canUpdate);
        $discount = Discount::find($id);
        $categories = Category::parents()->get();
        return view('admin.discounts.edit', compact('categories', 'discount'));
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

        $$request->validate([
            'category_id' => [
                'required',
                Rule::unique('discounts')->ignore($id),
            ],
            'percentage_discount' => 'required',
            'expires' => 'required',
        ]);
        $discount->category_id = $request->category_id;
        $discount->amount = $request->percentage_discount;
        $discount->expires = $request->expires;
        $discount->save();

        (new Activity)->put("Updated a discount with id  " . $discount->id . 'and amount' . $discount->amount);

        return redirect()->route('discounts.index');
    }
}
