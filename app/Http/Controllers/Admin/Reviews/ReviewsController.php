<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Review;
use App\Models\PageBanner;
use App\Models\Order;
use Carbon\Carbon;
use App\Mail\ReviewMail;




class ReviewsController extends Controller
{
    //where we display art collection
	
	public $reviews;
	
	public function __construct()
    {	  
	    //$this->middleware('admin');	
    }
	
	public function  index()  
	{  
	    // $startDate = Carbon::createFromFormat('d/m/Y', '16/1/2022');
        // $endDate   = Carbon::createFromFormat('d/m/Y', '24/1/2022');
		// $orders    = Order::has('ordered_products')
		// ->whereBetween('created_at',[$startDate, $endDate])
		// ->get();

	    // foreach ($orders as $key => $order) {
		// 	try {
		// 		$when = now()->addMinutes(5); 
		// 		\Mail::to($order->user->email)
		// 			->send(new ReviewMail($order));
		// 	} catch (\Throwable $th) {
		// 		dd($th);
		// 		\Log::info("Mail error :".$th);
		// 	}
	    // }



	  // $this->updateStatus();

	   $reviews = Review::all();
	   //$review_image = PageBanner::where('page_name','reviews')->first();
	   return view('admin.reviews.index',compact('reviews'));
	}


	public function show($id)
    {
        $review = Review::find($id);
        return view('admin.reviews.show',compact('review'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
		
    }



	public function updateStatus()
    {          
		if (request()->id) { 
			$review = Review::find(request()->id);
			$review->is_verified = request()->accept;
			$review->save();
		}
    }

   

	
	public function destroy(Request $request) 
	{ 
		$rules = array(
			'_token' => 'required',
		);
		// dd(get_class(\new Validator));
		$validator = \Validator::make($request->all(),$rules);
		
		if ( empty ( $request->selected)) {
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');    
			return \Redirect::back()
						->withErrors($validator)
						->withInput();
		}
				
		Review::destroy($request->selected);
		return redirect()->back();
	}
	
}