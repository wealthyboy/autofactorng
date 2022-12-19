<?php

namespace App\Http\Controllers\Admin\Customers;

use App\DataTable\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomersController extends Table
{



    public function builder()
    {
        return User::query();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User())->customers()->latest()->paginate(100);
        $users = $this->getColumnListings(request(), $users);
        return   view('admin.customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.customers.show', compact('user'));
    }


    public function routes()
    {
        return [
            'edit' =>  [
                'admin.users.edit',
                'user'
            ],
            'update' => null,
            'show' => null,
            'destroy' =>  [
                'admin.users.destroy',
                'user'
            ],
            'create' => [
                'admin.users.create'
            ],
            'index' => null
        ];
    }

    public function unique()
    {
        return [
            'show'  => false,
            'right' => false,
            'edit' => false,
            'search' => true,
            'add' => false,
            'destroy' => true,
            'export' => true
        ];
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
