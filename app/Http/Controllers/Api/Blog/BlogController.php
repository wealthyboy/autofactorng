<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Information;
use Auth;
use App\Http\Helper;
use App\User;
use Illuminate\Validation\Rule;
use App\Http\Resources\CommentResource;

class BlogController extends Controller
{
    //where we display art collection
	
	public function __construct()
    {	  
	    //$this->middleware('admin'); 
    }

	public function  show(Request $request,Information $blog)  
	{   
        return CommentResource::collection($blog->comments);
	}
  	
}
