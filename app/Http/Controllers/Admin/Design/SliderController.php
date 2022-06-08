<?php

namespace App\Http\Controllers\Admin\Design;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Http\Utilities\Helper;



class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::sliders()->get();
        return view('admin.sliders.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cols = Helper::col_width();
        return view('admin.sliders.create',compact('cols'));
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
            'title' => 'required',
            'link' => 'required',
            'sort_order' => 'required',
            'image'=>'required|image:jpeg,png,jpg',
        ]);
        if($request->hasFile('image')) {
            $path =  $request->file('image')->store('public/images/sliders');
            $banner->image  = basename($path);
        }
        $banner->title = $request->title;
        $banner->link  = $request->link;
        $banner->slider   = 1;

        $banner->description   = $request->description;
        $banner->sort_order = $request->sort_order;
        $banner->save();
        return redirect()->route('admin_sliders');
    
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
    	return view('admin.sliders.edit',compact('banner','cols'));
    	 
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
    	if ($request->isMethod('POST')) {

            $banner = Banner::find($id);
            
    		$this->validate ( $request, [
    				'title' => 'required',
    				'link' => 'required',
    				'sort_order' => 'required',
    				'image'=>'image:jpeg,png',
    		] );
    		if($request->hasFile('image')) {
    			$path =  $request->file('image')->store('public/images/sliders');
                $banner->image  = basename($path);
    		} 
    		$banner->title = $request->title;
    		$banner->link = $request->link;
            $banner->sort_order = $request->sort_order;
            $banner->col   = $request->col_width;
    		$banner->save();
    		// $flash = app( 'App\Http\flash' );
    		// $flash->success( "Success", "Details Updated" );
    		return redirect()->route('admin_sliders');
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    	if ($request->isMethod ( 'post' )) {
    		$rules = array (
    				'_token' => 'required'
    		);
    		$validator = \Validator::make ( $request->all (), $rules );
    		if (empty ( $request->selected )) {
    			$validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
    			return \Redirect::back ()->withErrors ( $validator )->withInput ();
    		}
    		$path = base_path () . '/public/images/slider';
    		$images_to_delete = Banner::whereIn ('id', $request->selected )->get();
    		foreach ( $images_to_delete as $images ) {
    			\File::Delete ( $path . '/' . $images->image );
    		}
    		Banner::destroy( $request->selected );
    		$flash = app ( 'App\Http\flash' );
    		$flash->success ( "Success", "Deleted" );
    		return redirect()->back();
    	}
    }
}
