<?php

namespace App\Http\Controllers\Admin\Design;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Helper;
use Illuminate\Support\Facades\Storage;




class BannersController extends Controller
{

    public function __construct()
    {
        //$this->middleware('admin'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::banners()->get();
        return view('admin.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cols = Helper::col_width();
        return view('admin.banners.create',compact('cols'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Banner $banner)
    {

        $this->validate ( $request, [
            'link' => 'required',
            'sort_order' => 'required',
            'image'=>'required',
        ]);
        
        $banner->title = $request->title;
        $banner->link  = $request->link;
        $banner->col   = $request->col_width;
        $banner->sm_col_width   = $request->sm_col_width;
        $banner->md_col_width  = $request->md_col_width;
        $banner->class         = $request->class;
        $banner->type   = $request->type;
        $banner->use_text   = $request->use_text ? 1 : 0;
        $banner->description   = $request->description;
        $banner->image   = $request->image;
        $banner->sort_order = $request->sort_order;
        $banner->mobile_sort_order = $request->mobile_sort_order;
        $banner->save();
        return redirect()->route('banners.index');
    	
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
        $banner = Banner::find($id);
        $cols = Helper::col_width();
    	return view('admin.banners.edit',compact('banner','cols'));
    	 
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

        $banner = Banner::find($id);
        $this->validate ( $request, [
                'link' => 'required',
                'sort_order' => 'required',
        ] );
        
        $banner->title = $request->title;
        $banner->link  = $request->link;
        $banner->col   = $request->col_width;
        $banner->sm_col_width   = $request->sm_col_width;
        $banner->md_col_width  = $request->md_col_width;
        $banner->class         = $request->class;
        $banner->type   = $request->type;
        $banner->use_text   = $request->use_text ? 1 : 0;
        $banner->description   = $request->description;
        $banner->image   = $request->image;
        $banner->sort_order = $request->sort_order;
        $banner->mobile_sort_order = $request->mobile_sort_order;

        $banner->save();
        // $flash = app( 'App\Http\flash' );
        // $flash->success( "Success", "Details Updated" );
        return redirect()->route('banners.index');
    	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id=null)
    {   
      
        $rules = array (
                '_token' => 'required'
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $path = base_path () . '/images/slider';
        $images_to_delete = Banner::whereIn ('id', $request->selected )->get();
        foreach ( $images_to_delete as $images ) {
            \File::Delete ( $path . '/' . $images->image );
        }
        Banner::destroy( $request->selected );
        // $flash = app ( 'App\Http\flash' );
        // $flash->success ( "Success", "Deleted" );
        return redirect()->back();
    	
    }
}
