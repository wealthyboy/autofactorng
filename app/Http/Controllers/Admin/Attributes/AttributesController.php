<?php

namespace App\Http\Controllers\Admin\Attributes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;
use App\Http\Helper;
use App\User;
use App\Attribute;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
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
        $product_attributes = Attribute::parents()->get(); 
        return view('admin.product_attributes.index',compact('product_attributes'));
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
        if(  $request->filled('parent_id') ){
            $this->validate($request,[
                'name'=>[
                    'required',
                      Rule::unique('attributes')->where(function ($query) use ($request) {
                        $query->where('parent_id','!=',null)
                        ->where('parent_id',$request->parent_id);
                      })
                      
                   ],
            ]);

        } else {
            //define validation 
            $this->validate($request,[
                'name'=>[
                    'required',
                      Rule::unique('attributes')->where(function ($query) {
                        $query->where('parent_id','=',null);
                      })
                      
                ],
            ]);
        }
        $product_attribute = new Attribute;
        $product_attribute->name = $request->name;
        $product_attribute->sort_order = $request->sort_order;
        $product_attribute->color_code = $request->color_code;
        $product_attribute->image = $request->image;
        $product_attribute->slug = str_slug($request->name, '_');
        $product_attribute->parent_id  = $request->parent_id ? $request->parent_id : null;
        $product_attribute->type  = $request->type ? $request->type : null;
        $product_attribute->save();
        (new Activity)->Log("Created a new attribute called {$request->name}");
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::canTakeAction(4);
        $attr = Attribute::find($id);
        $product_attributes = Attribute::parents()->get();       
        return view('admin.product_attributes.edit',compact('product_attributes','attr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $product_attribute = Attribute::find($id);
        if( $request->filled('parent_id') ) {
            $this->validate($request,[
                'name'=>[
                    'required',
                        Rule::unique('attributes')->where(function ($query) use ($request) {
                        $query->where('parent_id', '=', $request->parent_id);
                        })->ignore($id)
                    ],
            ]);
        } 
        $this->validate($request,[
            'name'=>[
                'required',
                    Rule::unique('attributes')->ignore($id) 
                ],
        ]);

        $product_attribute->name=$request->name;
        $product_attribute->sort_order = $request->sort_order;
        $product_attribute->parent_id  = $request->parent_id ? $request->parent_id : null;
        $product_attribute->color_code = $request->color_code;
        $product_attribute->image = $request->image;
        $product_attribute->slug = str_slug($request->name, '_');

        $product_attribute->type  = $request->type ? $request->type : null;
        $product_attribute->save();
        //Log Activity
        (new Activity)->Log("Updated  Attribute {$request->name} ");
        return redirect()->action('Admin\Attributes\AttributesController@index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
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
        Attribute::destroy( $request->selected );
        return redirect()->back();
    }
}