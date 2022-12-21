<?php

namespace App\Http\Controllers\Admin\Promo;

use App\DataTable\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Promo;
use App\Models\User;

class PromoController extends Table
{

    public $deleted_names = 'name';

    public $deleted_specific = 'promos with color';


    public function builder()
    {
        return Promo::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos =  Promo::all();
        return view('admin.promo.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(User::canCreate);
        return view('admin.promo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promo = new Promo;
        $promo->bgcolor = $request->background_color;
        $promo->is_active = $request->is_active ? 1 : 0;
        $promo->save();
        (new Activity)->put("Created a new Promo with bg color {$request->background_color}", null);

        return redirect('admin/promos');
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
        User::canTakeAction(User::canUpdate);
        $promo = Promo::find($id);
        return view('admin.promo.edit', compact('promo'));
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
        $promo = Promo::find($id);
        $promo->bgcolor = $request->background_color;
        $promo->is_active = $request->is_active ? 1 : 0;
        $promo->save();
        (new Activity)->put("Updated a new Promo with bg color {$request->background_color}", null);


        return redirect('admin/promos');
    }
}
