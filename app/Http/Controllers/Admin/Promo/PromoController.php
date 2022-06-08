<?php

namespace App\Http\Controllers\Admin\Promo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promo;

class PromoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $promos =  Promo::all();
        return view('admin.promo.index',compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
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
        Promo::Insert($request->except('_token'));
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
        $promo = Promo::find($id);
		return view('admin.promo.edit',compact('promo'));
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
        $promo->background_color = $request->background_color;
        $promo->make_live = $request->make_live;
		$promo->save();
        return redirect('admin/promos'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = array(
                '_token' => 'required',
        );
        $validator = \Validator::make($request->all(),$rules);
        if ( empty ( $request->selected)) {
            $validator->getMessageBag()->add('Selected', 'Nothing to Delete');
            return \Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }
        Promo::destroy($request->selected);  	
        return redirect()->back();
            
    	
    }
}
