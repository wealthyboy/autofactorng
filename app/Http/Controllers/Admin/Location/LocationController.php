<?php

namespace App\Http\Controllers\Admin\Location;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Activity;
use App\Models\Http\Helper;
use App\Models\User;
use App\Http\Controllers\Controller;


use Illuminate\Validation\Rule;




class LocationController extends Table
{


    public $deleted_names = 'name';

    public $deleted_specific = 'locations';

    public function builder()
    {
        return Location::query();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::parents()->get();
        return view('admin.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        return view('admin.location.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {

        if ($request->filled('parent_id')) {
            $this->validate($request, [
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request) {
                        $query->where('parent_id', '!=', null)
                            ->where('parent_id', $request->parent_id);
                    })

                ],
            ]);
        } else {
            $slug = str_slug($request->name);
            //define validation 
            $this->validate($request, [
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) {
                        $query->where('parent_id', '=', null);
                    })

                ],
            ]);
        }

        $location = new Location;
        $location->name = $request->name;
        $location->parent_id  = $request->parent_id;
        $location->save();
        (new Activity)->put("Created a new Location called {$request->name}");
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        User::canTakeAction(User::canUpdate);
        $location = Location::find($id);
        $locations = Location::parents()->get();
        return view('admin.location.edit', compact('location', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $location = Location::find($id);
        if ($request->filled('parent_id')) {
            $locationId = Location::find($request->parent_id);
            $this->validate($request, [
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request, $location) {
                        $query->where('parent_id', '=', $request->parent_id);
                    })->ignore($id)

                ],
            ]);
        }
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('locations')->where(function ($query) use ($id) {
                    $query->where('parent_id', '=', null);
                })->ignore($id)

            ],
        ]);
        $location->name = $request->name;
        $location->parent_id     = $request->parent_id;
        $location->save();
        //Log Activity
        (new Activity)->put("Updated  Location {$request->name} ");
        return redirect()->action('Admin\Location\LocationController@index');
    }
}
