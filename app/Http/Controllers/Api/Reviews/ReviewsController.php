<?php

namespace App\Http\Controllers\Api\Reviews;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use App\Product;
use  App\Http\Resources\ReviewResourceCollection;
use Illuminate\Notifications\Notification;
use App\Notifications\ReviewNotification;


class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $reviews =  $product->reviews()->orderBy('created_at','DESC')->paginate(5);
        return ReviewResourceCollection::collection( $reviews );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Review $review)
    {
        //
        $user = $request->user();
        
        $path = optional($request->file('image'))->store('images/reviews');
        $path = !empty($path) ? asset($path) : null;

        $new_review =  $review->create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'description' => $request->description,
            'image' => $path
        ]);

        //new Review Notification
        $product = Product::find($request->product_id);
        $reviews =  $product->reviews()->orderBy('created_at','DESC')->paginate(5);
        $review = ReviewResourceCollection::collection( $reviews );

        $new_review = [];
        $new_review['product_name'] = $product->product_name;
        $new_review['full_name'] = $user->name;
        $new_review['description'] = $request->description;
        $new_review['rating'] = $request->rating;
        $new_review['email'] = $user->email;
        try {
            \Notification::route('mail', 'jacob.atam@gmail.com')
            ->notify(new ReviewNotification($new_review));
        } catch (\Throwable $th) {
            //throw $th;
        }
       
        return $review;
    }
    
}
