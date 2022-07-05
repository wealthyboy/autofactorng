<?php

namespace App\Http\Controllers\Admin\NewsLetter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\PageBanner;


class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $emails = Newsletter::all();
      $newsletter_image = PageBanner::where('page_name','newsletter')->first();
		  return view('admin.newsletter.index',compact('emails','newsletter_image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
      $newsletter = new NewsLetter;
      $newsletter->email = $request->email;
      $newsletter->email_list_id  = $id;
      $newsletter->save();
      //(new Activity)->Log("Created a new Location called {$request->name}");
      return redirect()->route('lists.index'); 
    }
    
}
