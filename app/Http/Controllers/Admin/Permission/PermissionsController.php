<?php

namespace App\Http\Controllers\Admin\Permission;

use App\DataTable\Table;
use App\Models\Permission;
use App\Models\Activity;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class PermissionsController extends Table
{

    public $deleted_names = 'name';

    public $deleted_specific = 'Permissions';

    public function builder()
    {
        return Permission::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        User::canTakeAction(User::canAccessPermissions);
        $permissions = $this->getColumnListings(request(), Permission::paginate(100));
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check if user has Permission 2 code for create
        User::canTakeAction(User::canCreate);
        $permissions = Permission::$types;
        return view('admin.permissions.create', compact('permissions'));
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'permissions.edit',
                'permission'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'permissions.destroy',
                'permission'
            ],
            'create' => [
                'permissions.create'
            ],
            'index' => null
        ];
    }

    public function unique()
    {
        return [
            'show'  => false,
            'right' => false,
            'edit' => true,
            'search' => false,
            'add' => true,
            'destroy' => true,
            'export' => false,
            'banner' => false,
            'order' => false
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Permission $permission, Activity $activity)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->code = implode('', $request->code);
        $permission->save();
        $activity->put(" Created new permission called {$request->name}");
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
        // User::canTakeAction(3);
        $permission  = Permission::find($id);
        $permissions = Permission::$types;
        return view('admin.permissions.edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);
        $permission->name = $request->name;
        $permission->code = implode('', $request->code);
        $permission->save();
        //Log Activity
        (new Activity)->put("Updated  {$request->name} permission");
        return redirect()->route('permissions.index');
    }
}
