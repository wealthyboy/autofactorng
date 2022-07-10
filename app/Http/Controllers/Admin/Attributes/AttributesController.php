<?php

namespace App\Http\Controllers\Admin\Attributes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AttributeYear;

use App\Models\User;
use App\Models\Attribute;
use Illuminate\Validation\Rule;
use App\Http\Helper;


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
        $parents = Attribute::parents()->where('type','!=','Engine')->get(); 
        $attributes = Attribute::parents()->get(); 

        $types = Attribute::$types;
        $engines = Attribute::where('type','Engine')->get();
        return view('admin.attributes.index',compact('attributes','types','engines','parents'));
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
        $attribute = new Attribute;
        $attribute->name = $request->name;
        $attribute->sort_order = $request->sort_order;
        $attribute->slug = str_slug($request->name, '_');
        $attribute->parent_id  = $request->parent_id ? $request->parent_id : null;
        $attribute->type  = $request->type;
        $attribute->save();

        if (!empty($request->years)) {
            foreach ($request->years as $key => $year) {
                $attribute_year =  new AttributeYear;
                $attribute_year->year = $year;
                $attribute_year->attribute_id = $attribute->id;
                $attribute_year->save();
            }
           
        }

        //(new Activity)->Log("Created a new attribute called {$request->name}");
        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // User::canTakeAction(4);
        $attr = Attribute::find($id);
        $attributes = Attribute::parents()->where('type','!=','Engine')->get(); 
 
        $engines = Attribute::where('type','Engine')->get();   

        $types = Attribute::$types;
        $years =  $attr->attribute_years->pluck('year')->toArray();    
        return view('admin.attributes.edit',compact('attributes','attr','types','years','engines'));
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

        $attribute = Attribute::find($id);
        // if( $request->filled('parent_id') ) {
        //     $this->validate($request,[
        //         'name'=>[
        //             'required',
        //                 Rule::unique('attributes')->where(function ($query) use ($request) {
        //                  $query->where('parent_id', '=', $request->parent_id);
        //                 })->ignore($id)
        //             ],
        //     ]);
        // } 
        // $this->validate($request,[
        //     'name'=>[
        //         'required',
        //             Rule::unique('attributes')->ignore($id) 
        //         ],
        // ]);

        $attribute->name = $request->name;
        $attribute->sort_order = $request->sort_order;
        $attribute->slug = str_slug($request->name, '_');
        $attribute->parent_id  = $request->parent_id ? $request->parent_id : null;
        $attribute->type  = $request->type;
        $attribute->save();

        $years =  $attribute->attribute_years()->delete();    
        if (!empty($request->years)) {
            foreach ($request->years as $key => $year) {
                $attribute_year =  new AttributeYear;
                $attribute_year->year = $year;
                $attribute_year->attribute_id = $attribute->id;
                $attribute_year->save();
            }
           
        }
        //Log Activity
       // (new Activity)->Log("Updated  Attribute {$request->name} ");
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
        Attribute::destroy( $request->selected );
        return redirect()->back();
    }
}