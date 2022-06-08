<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Information;
use App\Comment;

use Auth;
use App\Http\Helper;
use App\User;
use Illuminate\Validation\Rule;



class CommentsController extends Controller
{
	
	public function __construct()
    {	  
	    $this->middleware('admin'); 
    }

	public function  comments(Request $request,$post_id)  {
		$posts = Information::find($post_id);
	    return view('admin.comments.index',compact('posts'));
    }
    
    public function  destroy(Request $request,$id)  
	{
        User::canTakeAction(5);
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
		Comment::destroy($request->selected);
		return redirect()->back()->with('status','removed');
	}

}
