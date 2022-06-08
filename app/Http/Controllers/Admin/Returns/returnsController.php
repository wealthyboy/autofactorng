<?php

namespace App\Http\Controllers\Admin\Returns;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Review;

class returnsController extends Controller
{
    //where we display art collection
	
	public $reviews;
	
	public function __construct()
    {	  
	    $this->middleware('admin');

			
    }
	
	public function  index()  { 
	 
	
	  return view('administration.auth.sales.returns',compact('review','reviews'));
	}
	
	public function  create()  { 
	   $reviews = $this->all();
	  return view('administration.auth.sales.returns',compact('review','reviews'));
	}
	
	
}