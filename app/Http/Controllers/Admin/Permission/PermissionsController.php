<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Permission;
use App\Activity;
use Illuminate\Http\Request;
use App\User;
use App\UserPermission;
use App\Http\Controllers\Controller;


class PermissionsController extends Controller
{   

    //

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions =Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        //Check if user has Permission 2 code for create
        //User::canTakeAction(2);
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Permission $permission,Activity $activity)
    {
        //
        $this->validate($request,[
            'name'=>'required|unique:permissions,name',
        ]);
        if($request->name == 'Super User' && !User::isSuperUser()){
           return redirect('/permission-denied');       
        }
        $permission = new Permission();
        $permission->name=$request->name;
        $permission->code=implode('',$request->code);
        $permission->save();
        // Log Activity
        $activity->Log(" Created new permission called {$request->name}");
        return redirect()->route('permissions.index');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        User::canTakeAction(3);
        $permission = Permission::find($id);
        return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $permission = Permission::find($id);
        $this->validate($request,[
            'name'=>'required|unique:permissions,name,'.$permission->id,
        ]);
        $permission->name=$request->name;
        $permission->code=implode('',$request->code);
        $permission->save();
        //Log Activity
        //(new Activity)->Log("Updated  {$request->name} permission");
        $flash = app( 'App\Http\Flash' );
        $flash->success( "Success", "Updated" );
        return redirect()->route('permissions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //dd($request->selected );
      //  User::canTakeAction(5);
        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        
        (new Activity)->Log("Deleted a permission");
        Permission::destroy( $request->selected );
        return redirect()->back();	
    }
}
