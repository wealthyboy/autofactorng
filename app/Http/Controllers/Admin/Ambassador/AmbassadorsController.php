<?php

namespace App\Http\Controllers\Admin\Ambassador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ambassador;
use App\User;
use App\Notifications\AmbassadorStatusNotification;


class AmbassadorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ambassadors = Ambassador::all();
        return view('admin.ambassador.index',compact('ambassadors'));
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
        //
        $amb = Ambassador::find($id);
        return view('admin.ambassador.show',compact('amb'));

    }

    public function sendNotification(Request $request,$id){
        $amb = Ambassador::find($id);
        if( null !== $amb ){
            \Notification::route('mail', $amb->email)
            ->notify(new AmbassadorStatusNotification($amb,$request));
            return back()->with("success", "Message Sent" );
        } 
        $flash->success( "Error", "Message not Sent, User deleted" );
        return back();      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id=null)
    {
        User::canTakeAction(5);

    	if ($request->isMethod('post')) {
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
    		Ambassador::destroy($request->selected);  	
    		$flash = app('App\Http\Flash');
    		$flash->success("Success","Deleted");
    		return redirect()->back();
    			
    	}
    }
}
