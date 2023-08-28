<?php

namespace App\Http\Controllers\Admin\Attributes;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AttributeYear;
use App\Models\Engine;

use App\Models\User;
use App\Models\Attribute;
use Illuminate\Validation\Rule;
use App\Http\Helper;


class AttributesController extends Table
{


    public $deleted_names = 'name';

    public $deleted_specific = 'Attributes';


    public function builder()
    {
        return Attribute::query();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Attribute::parents()->where('type', '!=', 'Engine')->get();
        $attributes = Attribute::parents()->get();
        $types = Attribute::$types;
        $engines = Engine::get();
        $helper = new Helper;

        return view('admin.attributes.index', compact('attributes', 'helper', 'types', 'engines', 'parents'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::canTakeAction(User::canCreate);
        if ($request->filled('parent_id')) {
            $this->validate($request, [
                'name' => [
                    'required',
                    Rule::unique('attributes')->where(function ($query) use ($request) {
                        $query->where('parent_id', '!=', null)
                            ->where('parent_id', $request->parent_id);
                    })

                ],
            ]);
        } else {
            //define validation 
            $this->validate($request, [
                'name' => [
                    'required',
                    Rule::unique('attributes')->where(function ($query) {
                        $query->where('parent_id', '=', null);
                    })

                ],
            ]);
        }
        $attribute = new Attribute;
        $attribute->name = $request->name;
        $attribute->sort_order = $request->sort_order;
        $attribute->slug = str_slug($request->name, '_');
        $attribute->parent_id = $request->parent_id ? $request->parent_id : null;
        $attribute->type = $request->type;
        $attribute->save();
        if (!empty($request->engine_id)) {
            $data  = [];
            foreach ($request->engine_id as $key => $engine_id) {
                foreach ($request->year_from[$engine_id] as $key => $year_from) {
                    $data[$engine_id] = ['year_From' => $year_from, 'year_to' => $request->year_to[$engine_id][0]];
                }
            }
            $attribute->engines()->sync($data);
        }



        if (!empty($request->years)) {
            foreach ($request->years as $key => $year) {
                $attribute_year =  new AttributeYear;
                $attribute_year->year = $year;
                $attribute_year->parent_id = $request->parent_id;
                $attribute_year->attribute_id = $attribute->id;
                $attribute_year->save();
            }
        }



        (new Activity)->put("Created a new attribute called {$request->name}", null);

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
        User::canTakeAction(User::canUpdate);
        $attr = Attribute::find($id);
        //dd($attr);
        $attributes = Attribute::parents()->get();
        $engines = Engine::get();
        $types = Attribute::$types;
        $years = $attr->attribute_years->pluck('year')->toArray();
        $helper = new Helper;

        return view('admin.attributes.edit', compact('attributes', 'helper', 'attr', 'types', 'years', 'engines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $attribute = Attribute::find($id);

        $attribute->name = $request->name;
        $attribute->sort_order = $request->sort_order;
        $attribute->slug = str_slug($request->name, '_');
        $attribute->parent_id  = $request->parent_id ? $request->parent_id : null;
        $attribute->type  = $request->type;
        $attribute->save();

        $data  = [];


        if (!empty($request->engine_id)) {
            foreach ($request->engine_id as $key => $engine_id) {
                foreach ($request->year_from[$engine_id] as $key => $year_from) {
                    $data[$engine_id] = ['year_From' => $year_from, 'year_to' => $request->year_to[$engine_id][0]];
                }
            }
        }


        $attribute->engines()->sync($data);


        $attribute->attribute_years()->delete();
        if (!empty($request->years)) {
            foreach ($request->years as $key => $year) {
                $attribute_year =  new AttributeYear;
                $attribute_year->year = $year;
                $attribute_year->parent_id = $request->parent_id;
                $attribute_year->attribute_id = $attribute->id;
                $attribute_year->save();
            }
        }
        //Log Activity
        (new Activity)->put("Updated  Attribute called {$request->name} ");
        return redirect()->action('Admin\Attributes\AttributesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
}
