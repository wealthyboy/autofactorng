<?php

namespace App\Http\Controllers\Admin\Templates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Template;


class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates =  Template::latest()->get();
        return view('admin.templates.index',compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $templates =  Template::latest()->get();
        return view('admin.templates.create',compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template  = new Template;
        $template->name = $request->name;
        $template->text = $request->html;
        $template->save();
        return redirect()->route('templates.index');
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
        $template   =  Template::find($id);
        return view('admin.templates.edit',compact('template'));
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
        $template  = Template::find($id);
        $template->name = $request->name;
        $template->text = $request->html;
        $template->save();
        return redirect()->route('templates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $rules = array (
            '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all(), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $count = count($request->selected);
        //(new Activity)->Log("Deleted  {$count} Products");
        try {
            Template::destroy( $request->selected );
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->back();
    }
}
