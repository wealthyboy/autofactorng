<?php

namespace App\Http\Controllers\Admin\EmailLists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmailList;


class EmailListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $email_lists =  EmailList::latest()->get();
        return view('admin.email_lists.index',compact('email_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email_lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required|unique:email_lists',
		]);
		EmailList::Insert($request->except('_token'));
		return redirect()->route('lists.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $email_list = EmailList::find($id);
        $email_list->load('news_letters');
        return view('admin.email_lists.show',compact('email_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $email_list = EmailList::find($id);
        return view('admin.email_lists.edit',compact('email_list'));
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
        $this->validate($request, [
			//'name' => 'required|unique:email_lists,'.$id,
        ]);
        $email_list = EmailList::find($id);
        $email_list->name = $request->name;
        $email_list->save();
		return redirect()->route('lists.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
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
		EmailList::destroy($request->selected);  	
		$flash = app('App\Http\Flash');
		$flash->success("Success","Deleted");
		return redirect()->back();
    		 
	}
}
