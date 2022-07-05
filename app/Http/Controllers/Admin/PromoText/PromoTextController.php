<?php

namespace App\Http\Controllers\Admin\PromoText;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PromoText;

class PromoTextController extends Controller
{   
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
        $promotexts =  PromoText::all();
        return view('admin.promotext.index',compact('promotexts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotext.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $promo_text  = new PromoText;
        $promo_text->promo = $request->promo;
        $promo_text->promo_id = $id;
        $promo_text->save();
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
        $promo_text = PromoText::find($id);
        return view('admin.promotext.edit',compact('promo_text'));
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
        $promo_text  = PromoText::find($id);
        $promo_text->promo = $request->promo;
        $promo_text->save();
        return redirect('admin/promos'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PromoText::destroy($id);  	
    	return redirect()->back();
    }
}
